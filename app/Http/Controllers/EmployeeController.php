<?php

namespace App\Http\Controllers;

use App\Employee\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
    }

    public function index(Request $request)
    {
        if (! $request->expectsJson() && ! $request->ajax()) {
            return view('employees.index');
        }

        $keyword = trim((string) $request->query('keyword', ''));

        $employees = Employee::query()
            ->active()
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($innerQuery) use ($keyword) {
                    $innerQuery->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('id_number', 'like', '%' . $keyword . '%');
                });
            })
            ->orderByDesc('id')
            ->get();

        return $this->successResponse($employees);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function show(Request $request, $id)
    {
        if (! $request->expectsJson() && ! $request->ajax()) {
            return view('employees.show', ['employeeId' => $id]);
        }

        $employee = Employee::with(['bankAccounts', 'emergencyContacts'])->findOrFail($id);

        return $this->successResponse($employee);
    }

    public function edit(Request $request, $id)
    {
        if (! $request->expectsJson() && ! $request->ajax()) {
            return view('employees.edit', ['employeeId' => $id]);
        }

        $employee = Employee::with(['bankAccounts', 'emergencyContacts'])->findOrFail($id);

        return $this->successResponse($employee);
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $employee = DB::transaction(function () use ($validated) {
                $employee = Employee::create($this->employeePayload($validated));

                $this->syncEmployeeRelations(
                    $employee,
                    $validated['bank_accounts'],
                    $validated['emergency_contacts'] ?? []
                );

                return $employee->load(['bankAccounts', 'emergencyContacts']);
            });

            return $this->successResponse($employee, 201);
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('建立員工資料失敗', 500);
        }
    }

    public function update(UpdateEmployeeRequest $request, $id): JsonResponse
    {
        $validated = $request->validated();

        try {
            $employee = DB::transaction(function () use ($validated, $id) {
                $employee = Employee::findOrFail($id);
                $employee->update($this->employeePayload($validated));

                $this->syncEmployeeRelations(
                    $employee,
                    $validated['bank_accounts'],
                    $validated['emergency_contacts'] ?? []
                );

                return $employee->load(['bankAccounts', 'emergencyContacts']);
            });

            return $this->successResponse($employee);
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('更新員工資料失敗', 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            DB::transaction(function () use ($id) {
                $employee = Employee::findOrFail($id);
                $employee->delete();
            });

            return $this->successResponse(null);
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('刪除員工資料失敗', 500);
        }
    }

    private function employeePayload(array $validated): array
    {
        $zipcode = $validated['address_zipcode'] ?? null;
        $county = $validated['address_county'] ?? null;
        $district = $validated['address_district'] ?? null;
        $others = $validated['address_others'] ?? null;

        $composedAddress = trim(implode('', array_filter([$zipcode, $county, $district, $others], function ($item) {
            return ! is_null($item) && $item !== '';
        })));

        return [
            'name' => $validated['name'],
            'gender' => isset($validated['gender']) ? (int) $validated['gender'] : null,
            'nationality' => $validated['nationality'] ?? null,
            'id_type' => isset($validated['id_type']) ? (int) $validated['id_type'] : null,
            'id_number' => $validated['id_number'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address_zipcode' => $zipcode,
            'address_county' => $county,
            'address_district' => $district,
            'address_others' => $others,
            'base_salary' => isset($validated['base_salary']) ? (float) $validated['base_salary'] : 29500,
            'health_insurance_dependents' => isset($validated['health_insurance_dependents']) ? (int) $validated['health_insurance_dependents'] : 0,
            'status' => isset($validated['status']) ? (int) $validated['status'] : Employee::STATUS_ACTIVE,
            'hired_date' => $validated['hired_date'] ?? null,
            'resigned_date' => $validated['resigned_date'] ?? null,
        ];
    }

    private function syncEmployeeRelations(Employee $employee, array $bankAccounts, array $emergencyContacts): void
    {
        $employee->bankAccounts()->delete();
        $employee->emergencyContacts()->delete();

        $employee->bankAccounts()->createMany($this->normalizeBankAccounts($bankAccounts));

        if (! empty($emergencyContacts)) {
            $employee->emergencyContacts()->createMany($this->normalizeEmergencyContacts($emergencyContacts));
        }
    }

    private function normalizeBankAccounts(array $bankAccounts): array
    {
        $result = [];
        $primaryAssigned = false;

        foreach ($bankAccounts as $index => $bankAccount) {
            $isPrimary = (int) ($bankAccount['is_primary'] ?? 0) === 1;

            if ($isPrimary && ! $primaryAssigned) {
                $primaryAssigned = true;
            } else {
                $isPrimary = false;
            }

            $result[] = [
                'bank_code' => $bankAccount['bank_code'],
                'bank_name' => $bankAccount['bank_name'],
                'account_number' => $bankAccount['account_number'],
                'is_primary' => $isPrimary ? 1 : 0,
            ];

            if (! $primaryAssigned && $index === count($bankAccounts) - 1) {
                $result[0]['is_primary'] = 1;
            }
        }

        return $result;
    }

    private function normalizeEmergencyContacts(array $emergencyContacts): array
    {
        $result = [];

        foreach ($emergencyContacts as $contact) {
            $result[] = [
                'relationship' => $contact['relationship'],
                'name' => $contact['name'],
                'phone' => $contact['phone'],
            ];
        }

        return $result;
    }

    private function successResponse($data, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $status);
    }

    private function errorResponse(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}

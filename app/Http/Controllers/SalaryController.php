<?php

namespace App\Http\Controllers;

use App\Employee\Employee;
use App\Employee\EmployeeAttendanceLog;
use App\Employee\EmployeeSalaryAddition;
use App\Employee\EmployeeSalaryDeduction;
use App\Employee\EmployeeSalaryRecord;
use App\Http\Requests\StoreAdditionRequest;
use App\Http\Requests\StoreDeductionRequest;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateAdditionRequest;
use App\Http\Requests\UpdateDeductionRequest;
use App\Http\Requests\UpdateSalaryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * 顯示薪資計算頁面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->is('backend/salary/calculator')) {
            return view('salary.calculator');
        }
        if (!$request->ajax() && !$request->wantsJson()) {
            return view('salary.index');
        }

        [$year, $month] = $this->resolveYearMonth($request);

        $employees = Employee::query()
            ->active()
            ->select(['id', 'name', 'base_salary'])
            ->orderBy('id')
            ->get();

        $records = EmployeeSalaryRecord::query()
            ->where('year', $year)
            ->where('month', $month)
            ->whereIn('employee_id', $employees->pluck('id'))
            ->get()
            ->keyBy('employee_id');

        $data = $employees->map(function (Employee $employee) use ($records) {
            $record = $records->get($employee->id);

            return [
                'id' => $employee->id,
                'name' => $employee->name,
                'base_salary' => $employee->base_salary,
                'salary_record' => $record ? [
                    'id' => $record->id,
                    'net_salary' => $record->net_salary,
                    'status' => $record->status,
                    'confirmed_at' => optional($record->confirmed_at)->format('Y-m-d H:i:s'),
                ] : null,
            ];
        })->values();

        return $this->success([
            'year' => $year,
            'month' => $month,
            'employees' => $data,
        ]);
    }

    /**
     * 計算員工薪資
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        // 驗證輸入
        $validated = $request->validate([
            'base_salary' => 'required|numeric|min:0',
            'leave_days' => 'nullable|numeric|min:0',
            'leave_hours' => 'nullable|numeric|min:0',
            'overtime_list' => 'nullable|array',
            'overtime_list.*.hours' => 'nullable|numeric|min:0',
            'overtime_list.*.days' => 'nullable|numeric|min:0|integer',
        ]);

        $baseSalary = (float) $validated['base_salary'];
        $leaveDays = (float) ($validated['leave_days'] ?? 0);
        $leaveHours = (float) ($validated['leave_hours'] ?? 0);
        $overtimeList = $validated['overtime_list'] ?? [];

        // 計算時薪基準
        $hourlyBase = $baseSalary / 30 / 8;

        // 計算單日加班費
        $calculateDailyOvertimePay = function ($hours) use ($hourlyBase) {
            if ($hours <= 0) {
                return 0;
            }
            if ($hours <= 2) {
                return $hours * $hourlyBase * 1.34;
            } else {
                return (2 * $hourlyBase * 1.34) + (($hours - 2) * $hourlyBase * 1.67);
            }
        };

        // 計算當月加班費
        $monthlyOvertimePay = 0;
        foreach ($overtimeList as $item) {
            $hours = (float) ($item['hours'] ?? 0);
            $days = (int) ($item['days'] ?? 0);
            if ($hours > 0 && $days > 0) {
                $dailyPay = $calculateDailyOvertimePay($hours);
                $monthlyOvertimePay += $dailyPay * $days;
            }
        }

        // 計算請假扣款
        $leaveDeduction = ($leaveDays * 8 + $leaveHours) * $hourlyBase;

        // 計算最終實領薪資
        $finalSalary = $baseSalary + $monthlyOvertimePay - $leaveDeduction;

        return response()->json([
            'success' => true,
            'data' => [
                'hourly_base' => round($hourlyBase, 2),
                'hourly_base_formatted' => number_format(round($hourlyBase), 0, '.', ','),
                'monthly_overtime_pay' => round($monthlyOvertimePay, 2),
                'monthly_overtime_pay_formatted' => number_format(round($monthlyOvertimePay), 0, '.', ','),
                'leave_deduction' => round($leaveDeduction, 2),
                'leave_deduction_formatted' => number_format(round($leaveDeduction), 0, '.', ','),
                'base_salary' => $baseSalary,
                'base_salary_formatted' => number_format($baseSalary, 0, '.', ','),
                'final_salary' => round($finalSalary, 2),
                'final_salary_formatted' => number_format(round($finalSalary), 0, '.', ','),
            ]
        ]);
    }

    public function edit(Request $request, int $employeeId)
    {
        if (!$request->ajax() && !$request->wantsJson()) {
            $employee = Employee::query()->find($employeeId, ['id']);
            if (!$employee) {
                abort(404);
            }

            return view('salary.edit', ['employeeId' => $employeeId]);
        }

        [$year, $month] = $this->resolveYearMonth($request);

        $employee = Employee::query()->find($employeeId, [
            'id',
            'name',
            'base_salary',
            'health_insurance_dependents',
            'hired_date',
        ]);
        if (!$employee) {
            return $this->error('員工資料不存在。', 404);
        }

        $attendanceSummary = $this->buildAttendanceSummary($employeeId, $year, $month, (float) $employee->base_salary);

        $salaryRecord = EmployeeSalaryRecord::query()
            ->where('employee_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->with(['additions', 'deductions'])
            ->first();

        return $this->success([
            'year' => $year,
            'month' => $month,
            'employee' => [
                'id' => $employee->id,
                'name' => $employee->name,
                'base_salary' => $employee->base_salary,
                'health_insurance_dependents' => $employee->health_insurance_dependents,
                'hired_date' => optional($employee->hired_date)->format('Y-m-d'),
            ],
            'attendance_summary' => $attendanceSummary,
            'salary_record' => $salaryRecord,
        ]);
    }

    public function store(StoreSalaryRequest $request, int $employeeId): JsonResponse
    {
        $validated = $request->validated();

        $employee = Employee::query()->find($employeeId);
        if (!$employee) {
            return $this->error('員工資料不存在。', 404);
        }

        $year = (int) $validated['year'];
        $month = (int) $validated['month'];
        $baseSalary = (float) $validated['base_salary'];

        $exists = EmployeeSalaryRecord::query()
            ->where('employee_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->exists();

        if ($exists) {
            return $this->error('該員工本月份薪資單已存在。', 422);
        }

        $record = DB::transaction(function () use ($employee, $year, $month, $baseSalary) {
            $summary = $this->buildAttendanceSummary($employee->id, $year, $month, $baseSalary);

            $record = EmployeeSalaryRecord::query()->create([
                'employee_id' => $employee->id,
                'year' => $year,
                'month' => $month,
                'base_salary' => $baseSalary,
                'hourly_rate' => $summary['hourly_rate'],
                'leave_hours' => $summary['leave_hours'],
                'leave_deduction' => $summary['leave_deduction'],
                'overtime_hours_134' => $summary['overtime_hours_134'],
                'overtime_hours_167' => $summary['overtime_hours_167'],
                'overtime_pay' => $summary['overtime_pay'],
                'health_insurance_dependents' => (int) $employee->health_insurance_dependents,
                'regular_wage' => $baseSalary,
                'labor_insurance_amount' => 0,
                'health_insurance_amount' => 0,
                'addition_total' => 0,
                'deduction_total' => 0,
                'net_salary' => round($baseSalary - $summary['leave_deduction'] + $summary['overtime_pay'], 2),
                'status' => EmployeeSalaryRecord::STATUS_DRAFT,
                'note' => null,
                'confirmed_at' => null,
            ]);

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function update(UpdateSalaryRequest $request, int $id): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $validated = $request->validated();

        $record = DB::transaction(function () use ($record, $validated) {
            $baseSalary = (float) $validated['base_salary'];

            $summary = $this->buildAttendanceSummary(
                (int) $record->employee_id,
                (int) $record->year,
                (int) $record->month,
                $baseSalary
            );

            $record->fill([
                'base_salary' => $baseSalary,
                'health_insurance_dependents' => (int) $validated['health_insurance_dependents'],
                'note' => $validated['note'] ?? null,
                'hourly_rate' => $summary['hourly_rate'],
                'leave_deduction' => $summary['leave_deduction'],
                'overtime_pay' => $summary['overtime_pay'],
            ]);
            $record->save();

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function confirm(int $id): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }

        $record = DB::transaction(function () use ($record) {
            $record->status = EmployeeSalaryRecord::STATUS_CONFIRMED;
            $record->confirmed_at = now();
            $record->save();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function unconfirm(int $id): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }

        $record = DB::transaction(function () use ($record) {
            $record->status = EmployeeSalaryRecord::STATUS_DRAFT;
            $record->confirmed_at = null;
            $record->save();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function storeAddition(StoreAdditionRequest $request, int $id): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $validated = $request->validated();

        $record = DB::transaction(function () use ($record, $validated) {
            $isMeal = $validated['type'] === EmployeeSalaryAddition::TYPE_MEAL;
            $unitPrice = $isMeal ? (float) $validated['unit_price'] : null;
            $quantity = $isMeal ? (float) $validated['quantity'] : null;
            $amount = $isMeal ? round($unitPrice * $quantity, 2) : (float) $validated['amount'];

            $record->additions()->create([
                'type' => $validated['type'],
                'name' => $validated['name'],
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'amount' => $amount,
                'is_regular_wage' => (int) $validated['is_regular_wage'],
            ]);

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function updateAddition(UpdateAdditionRequest $request, int $id, int $additionId): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $addition = $record->additions()->where('id', $additionId)->first();
        if (!$addition) {
            return $this->error('加項資料不存在。', 404);
        }
        $validated = $request->validated();

        $record = DB::transaction(function () use ($record, $addition, $validated) {
            $isMeal = $validated['type'] === EmployeeSalaryAddition::TYPE_MEAL;
            $unitPrice = $isMeal ? (float) $validated['unit_price'] : null;
            $quantity = $isMeal ? (float) $validated['quantity'] : null;
            $amount = $isMeal ? round($unitPrice * $quantity, 2) : (float) $validated['amount'];

            $addition->fill([
                'type' => $validated['type'],
                'name' => $validated['name'],
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'amount' => $amount,
                'is_regular_wage' => (int) $validated['is_regular_wage'],
            ]);
            $addition->save();

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function destroyAddition(int $id, int $additionId): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $record = DB::transaction(function () use ($record, $additionId) {
            $addition = $record->additions()->where('id', $additionId)->first();
            if (!$addition) {
                return null;
            }
            $addition->delete();

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });
        if (!$record) {
            return $this->error('加項資料不存在。', 404);
        }

        return $this->success($record);
    }

    public function storeDeduction(StoreDeductionRequest $request, int $id): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $validated = $request->validated();

        $record = DB::transaction(function () use ($record, $validated) {
            $record->deductions()->create([
                'type' => $validated['type'],
                'name' => $validated['name'],
                'amount' => (float) $validated['amount'],
                'is_regular_wage' => (int) $validated['is_regular_wage'],
            ]);

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function updateDeduction(UpdateDeductionRequest $request, int $id, int $deductionId): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $deduction = $record->deductions()->where('id', $deductionId)->first();
        if (!$deduction) {
            return $this->error('減項資料不存在。', 404);
        }
        $validated = $request->validated();

        $record = DB::transaction(function () use ($record, $deduction, $validated) {
            $deduction->fill([
                'type' => $validated['type'],
                'name' => $validated['name'],
                'amount' => (float) $validated['amount'],
                'is_regular_wage' => (int) $validated['is_regular_wage'],
            ]);
            $deduction->save();

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });

        return $this->success($record);
    }

    public function destroyDeduction(int $id, int $deductionId): JsonResponse
    {
        $record = EmployeeSalaryRecord::query()->find($id);
        if (!$record) {
            return $this->error('薪資單不存在。', 404);
        }
        if (!$this->ensureDraft($record)) {
            return $this->error('薪資已確認，無法修改。', 403);
        }

        $record = DB::transaction(function () use ($record, $deductionId) {
            $deduction = $record->deductions()->where('id', $deductionId)->first();
            if (!$deduction) {
                return null;
            }
            $deduction->delete();

            $record->recalcNetSalary();

            return $record->fresh(['additions', 'deductions']);
        });
        if (!$record) {
            return $this->error('減項資料不存在。', 404);
        }

        return $this->success($record);
    }

    protected function resolveYearMonth(Request $request): array
    {
        $now = now();
        $year = (int) $request->query('year', $now->year);
        $month = (int) $request->query('month', $now->month);

        if ($year < 2000 || $year > 2100) {
            $year = (int) $now->year;
        }

        if ($month < 1 || $month > 12) {
            $month = (int) $now->month;
        }

        return [$year, $month];
    }

    protected function buildAttendanceSummary(int $employeeId, int $year, int $month, float $baseSalary): array
    {
        $hourlyRate = round($baseSalary / 240, 4);

        $leaveHours = (float) EmployeeAttendanceLog::query()
            ->where('employee_id', $employeeId)
            ->where('type', EmployeeAttendanceLog::TYPE_LEAVE)
            ->whereYear('log_date', $year)
            ->whereMonth('log_date', $month)
            ->sum('hours');

        $leaveDeduction = round(($baseSalary / 30 / 8) * $leaveHours, 2);

        $dailyOvertimeLogs = EmployeeAttendanceLog::query()
            ->selectRaw('log_date, SUM(hours) as day_total_hours')
            ->where('employee_id', $employeeId)
            ->where('type', EmployeeAttendanceLog::TYPE_OVERTIME)
            ->whereYear('log_date', $year)
            ->whereMonth('log_date', $month)
            ->groupBy('log_date')
            ->get();

        $hours134 = 0.0;
        $hours167 = 0.0;

        foreach ($dailyOvertimeLogs as $log) {
            $dailyHours = (float) $log->day_total_hours;
            $hours134 += min(2, $dailyHours);
            $hours167 += max(0, $dailyHours - 2);
        }

        $hours134 = round($hours134, 1);
        $hours167 = round($hours167, 1);
        $overtimePay = round(($hourlyRate * 1.34 * $hours134) + ($hourlyRate * 1.67 * $hours167), 2);

        return [
            'hourly_rate' => $hourlyRate,
            'leave_hours' => round($leaveHours, 1),
            'leave_deduction' => $leaveDeduction,
            'overtime_hours_134' => $hours134,
            'overtime_hours_167' => $hours167,
            'overtime_pay' => $overtimePay,
        ];
    }

    protected function ensureDraft(EmployeeSalaryRecord $record): bool
    {
        return (int) $record->status !== EmployeeSalaryRecord::STATUS_CONFIRMED;
    }

    protected function success($data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    protected function error(string $message, int $status): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}

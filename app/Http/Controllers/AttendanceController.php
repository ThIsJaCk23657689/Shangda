<?php

namespace App\Http\Controllers;

use App\Employee\Employee;
use App\Employee\EmployeeAttendanceLog;
use App\Http\Requests\StoreAttendanceRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
    }

    public function index(Request $request, $employeeId)
    {
        if (! $request->expectsJson() && ! $request->ajax()) {
            return view('attendance.index', ['employeeId' => (int) $employeeId]);
        }

        $employee = Employee::query()->findOrFail($employeeId);
        [$year, $month] = $this->resolveYearMonth($request);

        return $this->successResponse($this->buildAttendanceData($employee, $year, $month));
    }

    public function store(StoreAttendanceRequest $request, $employeeId): JsonResponse
    {
        $validated = $request->validated();

        try {
            $employee = Employee::query()->findOrFail($employeeId);

            DB::transaction(function () use ($employee, $validated) {
                EmployeeAttendanceLog::query()->create([
                    'employee_id' => $employee->id,
                    'log_date' => $validated['log_date'],
                    'type' => (int) $validated['type'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'hours' => $this->calculateHours($validated['start_time'], $validated['end_time']),
                    'note' => $validated['note'] ?? null,
                ]);
            });

            [$year, $month] = $this->resolveYearMonthFromDate($validated['log_date']);
            return $this->successResponse($this->buildAttendanceData($employee, $year, $month), 201);
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('新增出勤記錄失敗', 500);
        }
    }

    public function update(StoreAttendanceRequest $request, $employeeId, $id): JsonResponse
    {
        $validated = $request->validated();

        try {
            $employee = Employee::query()->findOrFail($employeeId);

            DB::transaction(function () use ($employee, $id, $validated) {
                $log = EmployeeAttendanceLog::query()
                    ->where('employee_id', $employee->id)
                    ->findOrFail($id);

                $log->update([
                    'log_date' => $validated['log_date'],
                    'type' => (int) $validated['type'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'hours' => $this->calculateHours($validated['start_time'], $validated['end_time']),
                    'note' => $validated['note'] ?? null,
                ]);
            });

            [$year, $month] = $this->resolveYearMonthFromDate($validated['log_date']);
            return $this->successResponse($this->buildAttendanceData($employee, $year, $month));
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('更新出勤記錄失敗', 500);
        }
    }

    public function destroy(Request $request, $employeeId, $id): JsonResponse
    {
        try {
            $employee = Employee::query()->findOrFail($employeeId);
            [$year, $month] = $this->resolveYearMonth($request);

            DB::transaction(function () use ($employee, $id) {
                $log = EmployeeAttendanceLog::query()
                    ->where('employee_id', $employee->id)
                    ->findOrFail($id);

                $log->delete();
            });

            return $this->successResponse($this->buildAttendanceData($employee, $year, $month));
        } catch (Throwable $exception) {
            report($exception);
            return $this->errorResponse('刪除出勤記錄失敗', 500);
        }
    }

    private function resolveYearMonth(Request $request): array
    {
        $now = Carbon::now();
        $year = (int) $request->query('year', $now->year);
        $month = (int) $request->query('month', $now->month);

        if ($year < 1970 || $year > 2100) {
            $year = $now->year;
        }

        if ($month < 1 || $month > 12) {
            $month = $now->month;
        }

        return [$year, $month];
    }

    private function resolveYearMonthFromDate(string $logDate): array
    {
        $date = Carbon::parse($logDate);
        return [(int) $date->year, (int) $date->month];
    }

    private function calculateHours(string $startTime, string $endTime): float
    {
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);
        $minutes = $end->diffInMinutes($start);

        return floor($minutes / 30) * 0.5;
    }

    private function buildAttendanceData(Employee $employee, int $year, int $month): array
    {
        $logs = EmployeeAttendanceLog::query()
            ->where('employee_id', $employee->id)
            ->ofMonth($year, $month)
            ->orderBy('log_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get()
            ->map(function (EmployeeAttendanceLog $log) {
                return [
                    'id' => $log->id,
                    'log_date' => optional($log->log_date)->toDateString(),
                    'type' => (int) $log->type,
                    'type_label' => $log->type_label,
                    'start_time' => substr((string) $log->start_time, 0, 5),
                    'end_time' => substr((string) $log->end_time, 0, 5),
                    'hours' => (float) $log->hours,
                    'note' => $log->note,
                ];
            })
            ->values();

        $leaveHours = EmployeeAttendanceLog::calcLeaveHours($employee->id, $year, $month);
        $overtime = EmployeeAttendanceLog::calcOvertimeBreakdown($employee->id, $year, $month);

        $baseSalary = (float) $employee->base_salary;
        $hourlyRate = $baseSalary / 240;
        $overtimePay = round(
            ($hourlyRate * 1.34 * $overtime['hours_134']) +
            ($hourlyRate * 1.67 * $overtime['hours_167']),
            2
        );
        $leaveDeduction = round(($baseSalary / 30 / 8) * $leaveHours, 2);

        return [
            'employee' => [
                'id' => $employee->id,
                'name' => $employee->name,
                'base_salary' => $baseSalary,
            ],
            'year' => $year,
            'month' => $month,
            'logs' => $logs,
            'summary' => [
                'leave_hours' => round((float) $leaveHours, 1),
                'overtime_hours_134' => round((float) $overtime['hours_134'], 1),
                'overtime_hours_167' => round((float) $overtime['hours_167'], 1),
                'overtime_pay' => $overtimePay,
                'leave_deduction' => $leaveDeduction,
            ],
        ];
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

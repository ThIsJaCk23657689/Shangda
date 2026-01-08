<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SalaryController extends Controller
{
    /**
     * 顯示薪資計算頁面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('salary.calculator');
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
}

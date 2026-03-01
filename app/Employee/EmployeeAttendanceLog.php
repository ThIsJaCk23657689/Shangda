<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceLog extends Model
{
    protected $table = 'employee_attendance_logs';

    protected $fillable = [
        'employee_id',
        'log_date',
        'type',
        'start_time',
        'end_time',
        'hours',
        'note',
    ];

    protected $casts = [
        'log_date' => 'date',
        'hours'    => 'float',
        'type'     => 'integer',
    ];

    // ----------------------------------------
    // 常數
    // ----------------------------------------

    const TYPE_LEAVE    = 0; // 請假
    const TYPE_OVERTIME = 1; // 加班

    // ----------------------------------------
    // Accessor
    // ----------------------------------------

    public function getTypeLabelAttribute(): string
    {
        return $this->type === self::TYPE_OVERTIME ? '加班' : '請假';
    }

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // ----------------------------------------
    // Scope
    // ----------------------------------------

    public function scopeOvertime($query)
    {
        return $query->where('type', self::TYPE_OVERTIME);
    }

    public function scopeLeave($query)
    {
        return $query->where('type', self::TYPE_LEAVE);
    }

    public function scopeOfMonth($query, int $year, int $month)
    {
        return $query->whereYear('log_date', $year)
                     ->whereMonth('log_date', $month);
    }

    // ----------------------------------------
    // 靜態工具：計算當月加班的 1.34 / 1.67 時數分佈
    // 規則：每天前兩小時 1.34 倍，第三小時起 1.67 倍
    // ----------------------------------------

    /**
     * 傳入 employee_id、年、月
     * 回傳 ['hours_134' => x, 'hours_167' => y]
     */
    public static function calcOvertimeBreakdown(int $employeeId, int $year, int $month): array
    {
        // 撈出當月所有加班紀錄，依日期分組
        $logs = static::where('employee_id', $employeeId)
            ->overtime()
            ->ofMonth($year, $month)
            ->get()
            ->groupBy(fn($log) => $log->log_date->toDateString());

        $hours134 = 0;
        $hours167 = 0;

        foreach ($logs as $date => $dayLogs) {
            $dailyTotal = $dayLogs->sum('hours');

            if ($dailyTotal <= 2) {
                $hours134 += $dailyTotal;
            } else {
                $hours134 += 2;
                $hours167 += ($dailyTotal - 2);
            }
        }

        return [
            'hours_134' => $hours134,
            'hours_167' => $hours167,
        ];
    }

    /**
     * 傳入 employee_id、年、月
     * 回傳當月請假總時數
     */
    public static function calcLeaveHours(int $employeeId, int $year, int $month): float
    {
        return (float) static::where('employee_id', $employeeId)
            ->leave()
            ->ofMonth($year, $month)
            ->sum('hours');
    }
}

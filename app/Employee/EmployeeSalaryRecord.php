<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryRecord extends Model
{
    protected $table = 'employee_salary_records';

    protected $fillable = [
        'employee_id',
        'year',
        'month',
        'base_salary',
        'hourly_rate',
        'leave_hours',
        'leave_deduction',
        'overtime_hours_134',
        'overtime_hours_167',
        'overtime_pay',
        'addition_total',
        'deduction_total',
        'net_salary',
        'note',
        'status',
        'confirmed_at',
    ];

    protected $casts = [
        'base_salary'        => 'float',
        'hourly_rate'        => 'float',
        'leave_hours'        => 'float',
        'leave_deduction'    => 'float',
        'overtime_hours_134' => 'float',
        'overtime_hours_167' => 'float',
        'overtime_pay'       => 'float',
        'addition_total'     => 'float',
        'deduction_total'    => 'float',
        'net_salary'         => 'float',
        'status'             => 'integer',
        'confirmed_at'       => 'datetime',
    ];

    // ----------------------------------------
    // 常數
    // ----------------------------------------

    const STATUS_DRAFT     = 0; // 草稿
    const STATUS_CONFIRMED = 1; // 已確認

    // ----------------------------------------
    // Accessor
    // ----------------------------------------

    public function getStatusLabelAttribute(): string
    {
        return $this->status === self::STATUS_CONFIRMED ? '已確認' : '草稿';
    }

    public function getIsConfirmedAttribute(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function additions()
    {
        return $this->hasMany(EmployeeSalaryAddition::class);
    }

    public function deductions()
    {
        return $this->hasMany(EmployeeSalaryDeduction::class);
    }

    // ----------------------------------------
    // Scope
    // ----------------------------------------

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    // ----------------------------------------
    // 核心：從出勤記錄計算並建立/更新薪資草稿
    // ----------------------------------------

    /**
     * 根據員工、年月、底薪，自動彙總出勤記錄並產生薪資草稿
     * 若該月已有草稿則更新，已確認則拒絕
     */
    public static function calculate(Employee $employee, int $year, int $month): self
    {
        // 已確認的不能重新計算
        $existing = static::where('employee_id', $employee->id)
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        if ($existing && $existing->is_confirmed) {
            throw new \Exception("該月薪資已確認，無法重新計算。");
        }

        $baseSalary = $employee->base_salary; // 請確保 Employee 有此欄位或由外部傳入
        $hourlyRate = round($baseSalary / 240, 4);

        // --- 請假 ---
        $leaveHours     = EmployeeAttendanceLog::calcLeaveHours($employee->id, $year, $month);
        $leaveDeduction = round(($baseSalary / 30 / 8) * $leaveHours, 2);

        // --- 加班 ---
        $overtime     = EmployeeAttendanceLog::calcOvertimeBreakdown($employee->id, $year, $month);
        $overtimePay  = round(
            ($hourlyRate * 1.34 * $overtime['hours_134']) +
            ($hourlyRate * 1.67 * $overtime['hours_167']),
            2
        );

        $record = $existing ?? new static();
        $record->fill([
            'employee_id'        => $employee->id,
            'year'               => $year,
            'month'              => $month,
            'base_salary'        => $baseSalary,
            'hourly_rate'        => $hourlyRate,
            'leave_hours'        => $leaveHours,
            'leave_deduction'    => $leaveDeduction,
            'overtime_hours_134' => $overtime['hours_134'],
            'overtime_hours_167' => $overtime['hours_167'],
            'overtime_pay'       => $overtimePay,
            'status'             => self::STATUS_DRAFT,
        ]);

        // net_salary 暫時不含加減項，待加減項存入後再呼叫 recalcNetSalary()
        $record->net_salary = round(
            $baseSalary - $leaveDeduction + $overtimePay, 2
        );

        $record->save();

        return $record;
    }

    /**
     * 重新加總加減項並更新 net_salary
     * 每次新增/修改/刪除加減項後都應呼叫此方法
     */
    public function recalcNetSalary(): void
    {
        $this->addition_total  = (float) $this->additions()->sum('amount');
        $this->deduction_total = (float) $this->deductions()->sum('amount');
        $this->net_salary      = round(
            $this->base_salary
            - $this->leave_deduction
            + $this->overtime_pay
            + $this->addition_total
            - $this->deduction_total,
            2
        );
        $this->save();
    }

    /**
     * 確認薪資（鎖定，不可再修改）
     */
    public function confirm(): void
    {
        $this->status       = self::STATUS_CONFIRMED;
        $this->confirmed_at = now();
        $this->save();
    }
}

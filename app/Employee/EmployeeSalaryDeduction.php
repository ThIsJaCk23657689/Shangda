<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryDeduction extends Model
{
    protected $table = 'employee_salary_deductions';

    protected $fillable = [
        'employee_salary_record_id',
        'type',
        'name',
        'amount',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    // ----------------------------------------
    // 常數
    // ----------------------------------------

    const TYPE_LABOR_INSURANCE  = 'labor_insurance';  // 勞保
    const TYPE_HEALTH_INSURANCE = 'health_insurance'; // 健保
    const TYPE_SERVICE_FEE      = 'service_fee';      // 代辦費
    const TYPE_WATER            = 'water';            // 水費
    const TYPE_ELECTRICITY      = 'electricity';      // 電費
    const TYPE_HOUSING          = 'housing';          // 住宿費
    const TYPE_ADVANCE          = 'advance';          // 預支款
    const TYPE_OTHER            = 'other';            // 其他

    public static function typeLabels(): array
    {
        return [
            self::TYPE_LABOR_INSURANCE  => '勞保',
            self::TYPE_HEALTH_INSURANCE => '健保',
            self::TYPE_SERVICE_FEE      => '代辦費',
            self::TYPE_WATER            => '水費',
            self::TYPE_ELECTRICITY      => '電費',
            self::TYPE_HOUSING          => '住宿費',
            self::TYPE_ADVANCE          => '預支款',
            self::TYPE_OTHER            => '其他',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return static::typeLabels()[$this->type] ?? $this->type;
    }

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    public function salaryRecord()
    {
        return $this->belongsTo(EmployeeSalaryRecord::class, 'employee_salary_record_id');
    }

    // ----------------------------------------
    // 建立減項後自動觸發 net_salary 重算
    // ----------------------------------------

    protected static function booted()
    {
        static::saved(function (self $deduction) {
            $deduction->salaryRecord->recalcNetSalary();
        });

        static::deleted(function (self $deduction) {
            $deduction->salaryRecord->recalcNetSalary();
        });
    }
}

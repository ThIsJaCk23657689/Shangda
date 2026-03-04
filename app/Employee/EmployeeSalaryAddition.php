<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryAddition extends Model
{
    protected $table = 'employee_salary_additions';

    protected $fillable = [
        'employee_salary_record_id',
        'type',
        'name',
        'unit_price',
        'quantity',
        'amount',
        'is_regular_wage',
    ];

    protected $casts = [
        'unit_price' => 'float',
        'quantity'   => 'float',
        'amount'     => 'float',
        'is_regular_wage' => 'integer',
    ];

    // ----------------------------------------
    // 常數
    // ----------------------------------------

    const TYPE_SENIORITY  = 'seniority';   // 年資獎金
    const TYPE_POSITION   = 'position';    // 職務津貼
    const TYPE_PRODUCTION = 'production';  // 生產獎金
    const TYPE_HOLIDAY    = 'holiday';     // 節慶獎金
    const TYPE_YEAR_END   = 'year_end';    // 年終獎金
    const TYPE_MEAL       = 'meal';        // 餐費津貼（單價×天數）

    public static function typeLabels(): array
    {
        return [
            self::TYPE_SENIORITY  => '年資獎金',
            self::TYPE_POSITION   => '職務津貼',
            self::TYPE_PRODUCTION => '生產獎金',
            self::TYPE_HOLIDAY    => '節慶獎金',
            self::TYPE_YEAR_END   => '年終獎金',
            self::TYPE_MEAL       => '餐費津貼',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return static::typeLabels()[$this->type] ?? $this->type;
    }

    /**
     * 是否為單價×數量型（目前只有餐費津貼）
     */
    public function getIsUnitTypeAttribute(): bool
    {
        return $this->type === self::TYPE_MEAL;
    }

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    public function salaryRecord()
    {
        return $this->belongsTo(EmployeeSalaryRecord::class, 'employee_salary_record_id');
    }

    // ----------------------------------------
    // 建立加項後自動觸發 net_salary 重算
    // ----------------------------------------

    protected static function booted()
    {
        static::saved(function (self $addition) {
            $addition->salaryRecord->recalcNetSalary();
        });

        static::deleted(function (self $addition) {
            $addition->salaryRecord->recalcNetSalary();
        });
    }
}

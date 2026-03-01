<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankAccount extends Model
{
    protected $table = 'employee_bank_accounts';

    protected $fillable = [
        'employee_id',
        'bank_code',
        'bank_name',
        'account_number',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'integer',
    ];

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

    public function scopePrimary($query)
    {
        return $query->where('is_primary', 1);
    }
}

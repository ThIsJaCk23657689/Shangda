<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeEmergencyContact extends Model
{
    protected $table = 'employee_emergency_contacts';

    protected $fillable = [
        'employee_id',
        'relationship',
        'name',
        'phone'
    ];

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

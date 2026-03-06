<?php

namespace App\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeeBreakTimeSetting extends Model
{
    protected $table = 'employee_break_time_settings';

    protected $fillable = [
        'start_time',
        'end_time',
        'effective_date',
    ];

    protected $casts = [
        'effective_date' => 'date',
    ];

    public static function getSettingForDate(Carbon $date): ?self
    {
        return static::query()
            ->whereDate('effective_date', '<=', $date->toDateString())
            ->orderBy('effective_date', 'desc')
            ->first();
    }
}

<?php

use App\Employee\EmployeeBreakTimeSetting;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RecalculateHoursInEmployeeAttendanceLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('employee_attendance_logs')
            ->orderBy('id')
            ->chunkById(500, function ($logs) {
                foreach ($logs as $log) {
                    $logDate = Carbon::parse($log->log_date);
                    $setting = EmployeeBreakTimeSetting::getSettingForDate($logDate);

                    $workStart = Carbon::parse($logDate->toDateString() . ' ' . $log->start_time);
                    $workEnd = Carbon::parse($logDate->toDateString() . ' ' . $log->end_time);

                    $workMinutes = max(0, $workStart->diffInMinutes($workEnd, false));
                    $overlapMinutes = 0;

                    if ($setting !== null) {
                        $breakStart = Carbon::parse($logDate->toDateString() . ' ' . $setting->start_time);
                        $breakEnd = Carbon::parse($logDate->toDateString() . ' ' . $setting->end_time);

                        $overlapStart = $workStart->greaterThan($breakStart) ? $workStart : $breakStart;
                        $overlapEnd = $workEnd->lessThan($breakEnd) ? $workEnd : $breakEnd;

                        if ($overlapStart->lessThan($overlapEnd)) {
                            $overlapMinutes = $overlapStart->diffInMinutes($overlapEnd);
                        }
                    }

                    $hours = round(max(0, ($workMinutes - $overlapMinutes) / 60), 1);

                    DB::table('employee_attendance_logs')
                        ->where('id', $log->id)
                        ->update([
                            'hours' => $hours,
                            'updated_at' => now(),
                        ]);
                }
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

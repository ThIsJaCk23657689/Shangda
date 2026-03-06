<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeBreakTimeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secondEffectiveDate = Carbon::now()->startOfMonth()->addMonthNoOverflow();
        $firstEffectiveDate = $secondEffectiveDate->copy()->subMonthsNoOverflow(3);

        $now = now();

        DB::table('employee_break_time_settings')->updateOrInsert(
            ['effective_date' => $firstEffectiveDate->toDateString()],
            [
                'start_time' => '12:30:00',
                'end_time' => '13:00:00',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('employee_break_time_settings')->updateOrInsert(
            ['effective_date' => $secondEffectiveDate->toDateString()],
            [
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}

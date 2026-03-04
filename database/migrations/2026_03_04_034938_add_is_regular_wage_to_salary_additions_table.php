<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRegularWageToSalaryAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_salary_additions', function (Blueprint $table) {
            $table->tinyInteger('is_regular_wage')
                ->default(0)
                ->after('amount')
                ->comment('1=納入經常性薪資計算');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_salary_additions', function (Blueprint $table) {
            $table->dropColumn('is_regular_wage');
        });
    }
}

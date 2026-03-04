<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsuranceFieldsToSalaryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_salary_records', function (Blueprint $table) {
            $table->tinyInteger('health_insurance_dependents')
                ->default(0)
                ->after('overtime_pay')
                ->comment('健保眷屬數快照');

            $table->decimal('regular_wage', 10, 2)
                ->default(0)
                ->after('health_insurance_dependents')
                ->comment('經常性薪資');

            $table->decimal('labor_insurance_amount', 10, 2)
                ->default(0)
                ->after('regular_wage')
                ->comment('勞保員工自付額');

            $table->decimal('health_insurance_amount', 10, 2)
                ->default(0)
                ->after('labor_insurance_amount')
                ->comment('健保員工自付額（已乘眷屬倍數）');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_salary_records', function (Blueprint $table) {
            $table->dropColumn([
                'health_insurance_dependents',
                'regular_wage',
                'labor_insurance_amount',
                'health_insurance_amount',
            ]);
        });
    }
}

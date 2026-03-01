<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalaryDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_salary_record_id');

            $table->string('type', 30)->comment('項目類型');
            $table->string('name', 50)->comment('項目名稱（顯示用）');
            $table->decimal('amount', 10, 2)->comment('扣除金額');

            $table->timestamps();

            $table->foreign('employee_salary_record_id')
                  ->references('id')
                  ->on('employee_salary_records')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salary_deductions');
    }
}

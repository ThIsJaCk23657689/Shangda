<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalaryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');

            // 年月
            $table->smallInteger('year')->unsigned()->comment('西元年');
            $table->tinyInteger('month')->unsigned()->comment('月份 1-12');

            // 基本薪資快照
            $table->decimal('base_salary', 10, 2)->comment('當月底薪');
            $table->decimal('hourly_rate', 10, 4)->comment('時薪基準 base_salary/240');

            // 請假
            $table->decimal('leave_hours', 5, 1)->default(0)->comment('當月請假總時數');
            $table->decimal('leave_deduction', 10, 2)->default(0)->comment('請假扣薪金額');

            // 加班
            $table->decimal('overtime_hours_134', 5, 1)->default(0)->comment('適用1.34倍率的加班時數');
            $table->decimal('overtime_hours_167', 5, 1)->default(0)->comment('適用1.67倍率的加班時數');
            $table->decimal('overtime_pay', 10, 2)->default(0)->comment('加班費合計');

            // 加減項合計
            $table->decimal('addition_total', 10, 2)->default(0)->comment('加項合計');
            $table->decimal('deduction_total', 10, 2)->default(0)->comment('減項合計');

            // 最終結果
            $table->decimal('net_salary', 10, 2)->comment('實領薪資');

            // 狀態
            $table->string('note', 500)->nullable()->comment('備註');
            $table->tinyInteger('status')->default(0)->comment('0=草稿 1=已確認');
            $table->timestamp('confirmed_at')->nullable()->comment('確認時間');

            $table->timestamps();

            // 一個員工一個月只能有一筆
            $table->unique(['employee_id', 'year', 'month']);

            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('restrict'); // 有薪資記錄時不可刪除員工
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salary_records');
    }
}

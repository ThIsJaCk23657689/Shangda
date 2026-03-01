<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');

            // 基本資料
            $table->string('name', 50)->comment('姓名');
            $table->tinyInteger('gender')->comment('性別：0=女 1=男');
            $table->string('nationality', 50)->comment('國籍');

            // 證件資料
            $table->tinyInteger('id_type')->comment('證件類型：1=身分證 2=護照 3=居留證');
            $table->string('id_number', 20)->unique()->comment('證件號碼');

            // 個人資料
            $table->date('birth_date')->comment('出生年月日');
            $table->string('phone', 20)->comment('手機');
            $table->string('address', 200)->comment('住址');

            // 在職狀態
            $table->tinyInteger('status')->default(1)->comment('1=在職 0=離職');
            $table->date('hired_date')->comment('到職日');
            $table->date('resigned_date')->nullable()->comment('離職日');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

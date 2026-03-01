<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');

            $table->string('bank_code', 10)->comment('銀行代碼');
            $table->string('bank_name', 50)->comment('銀行名稱');
            $table->string('account_number', 30)->comment('帳號');
            $table->tinyInteger('is_primary')->default(1)->comment('1=主要帳號 0=其他');

            $table->timestamps();

            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
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
        Schema::dropIfExists('employee_bank_accounts');
    }
}

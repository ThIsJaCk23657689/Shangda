<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_emergency_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');

            $table->string('relationship', 20)->comment('與員工關係（父、母、配偶...）');
            $table->string('name', 50)->comment('聯絡人姓名');
            $table->string('phone', 20)->comment('聯絡人電話');
            $table->string('address', 200)->nullable()->comment('聯絡人住址');

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
        Schema::dropIfExists('employee_emergency_contacts');
    }
}

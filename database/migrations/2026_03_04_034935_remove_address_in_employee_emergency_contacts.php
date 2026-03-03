<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddressInEmployeeEmergencyContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_emergency_contacts', function (Blueprint $table) {
            $table->dropColumn(['address']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_emergency_contacts', function (Blueprint $table) {
            $table->string('address', 200)->nullable()->comment('聯絡人住址');
        });
    }
}

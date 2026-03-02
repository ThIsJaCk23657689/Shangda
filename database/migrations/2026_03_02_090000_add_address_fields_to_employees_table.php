<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('address_zipcode', 10)->nullable()->after('address');
            $table->string('address_county', 20)->nullable()->after('address_zipcode');
            $table->string('address_district', 20)->nullable()->after('address_county');
            $table->string('address_others', 200)->nullable()->after('address_district');
            $table->dropColumn(['address']);
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('address', 200)->comment('住址')->after('address_others');
            $table->dropColumn(['address_zipcode', 'address_county', 'address_district', 'address_others']);
        });
    }
}

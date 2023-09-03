<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsInConsumers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumers', function (Blueprint $table) {
            $table->dropUnique('consumers_email_unique');
            $table->dropUnique('consumers_account_unique');

            $table->string('email')->nullable()->change();
            $table->string('account')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumers', function (Blueprint $table) {
            $table->unique('email');
            $table->unique('account');
        });

        Schema::table('consumers', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->string('account')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
}

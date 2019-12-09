<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('tel',25)->nullable();
            $table->string('taxId',8)->nullable()->unique();
            $table->string('shortName',100)->nullable();
            $table->string('inCharge1',50);
            $table->string('tel1',25);
            $table->string('email1',100)->nullable();
            $table->string('inCharge2',50)->nullable();
            $table->string('tel2',25)->nullable();
            $table->string('email2',100)->nullable();
            $table->string('tax',25)->nullable();
            $table->string('companyAddress');
            $table->string('deliveryAddress');
            $table->string('invoiceAddress');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('expectReceived_at');
            $table->float('totalPrice')->default(0);
            $table->string('comment')->nullable();
            $table->integer('taxType')->default(1);//1~6
            $table->integer('invoiceType')->default(1);//1~5
            $table->string('address')->default('苗栗縣竹南鎮國泰路43號');



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
        Schema::dropIfExists('purchase_orders');
    }
}

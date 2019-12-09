<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('purchaseOrder_id');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('purchaseOrder_id')->references('id')->on('purchaseOrders');

            $table->double('price')->default(0);
            $table->double('totalPrice')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('comment')->nullable();
            $table->float('discount')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_supplier');
    }
}

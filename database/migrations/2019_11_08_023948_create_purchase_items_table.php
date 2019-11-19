<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //採購項目
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->increments('pi_id');
            $table->unsignedInteger('m_id');//原料id
            $table->unsignedInteger('po_id');//採購單id
            $table->integer('count');//數量
            $table->integer('price');//單價
            $table->tinyInteger('discount');//折數1~10
            $table->integer('total_price');//總金額
            $table->string('remark', 100);//備註

            $table->foreign('m_id')->references('m_id')->on('materials')->onDelete('cascade');
            $table->foreign('po_id')->references('po_id')->on('purchase_orders')->onDelete('cascade');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
}

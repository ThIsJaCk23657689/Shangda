<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 進貨單詳細資料表 (原物料 與 進貨單 之間多對多樞紐表)
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');

            $table->unsignedBigInteger('material_id')->comment('原物料編號');
            $table->unsignedBigInteger('purchaseOrder_id')->comment('進貨單編號');
            
            $table->integer('count')->comment('進貨單序號');
            $table->double('price')->default(0)->comment('單價');
            $table->integer('quantity')->default(0)->comment('數量');
            $table->float('discount')->default(1)->comment('折數');
            $table->double('subTotal')->default(0)->comment('小計');
            $table->string('comment')->nullable()->comment('備註');
            
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('purchaseOrder_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
}

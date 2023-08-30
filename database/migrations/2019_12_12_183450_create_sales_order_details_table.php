<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('sales_order_id')->comment('銷貨單編號');
            $table->unsignedBigInteger('product_id')->comment('商品編號');

            $table->integer('count')->comment('銷貨單序號');
            $table->double('price')->default(0)->comment('單價');
            $table->integer('quantity')->default(0)->comment('數量');
            $table->float('discount')->default(1)->comment('折數');
            $table->double('subTotal')->default(0)->comment('小計');
            $table->string('comment')->nullable()->comment('備註');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sales_order_id')->references('id')->on('sales_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order_details');
    }
}

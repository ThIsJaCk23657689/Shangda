<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            $table->unsignedBigInteger('cart_id')->comment('購物車編號');
            $table->unsignedBigInteger('product_id')->comment('商品編號');

            // $table->integer('count')->comment('銷貨單序號');
            $table->double('price')->default(0)->comment('單價');
            $table->integer('quantity')->default(0)->comment('數量');
            $table->float('discount')->default(1)->comment('折數');
            $table->double('subTotal')->default(0)->comment('小計');
            $table->string('comment')->nullable()->comment('備註');

            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('cart_details');
    }
}

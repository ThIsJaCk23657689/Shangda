<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->comment('商品編號');
            $table->unsignedBigInteger('consumer_id')->comment('顧客編號');
            $table->double('price')->default(0)->comment('價格增減'); //零售價加上該欄位數值，欲做折扣請輸入負值。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}

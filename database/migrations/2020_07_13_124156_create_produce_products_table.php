<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produce_products', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('produce_id')->comment('對應商品增量表主鍵的外來鍵');
            $table->unsignedBigInteger('product_id')->comment('所增量的商品編號');
            $table->double('quantity')->comment('所增量的數量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produce_products');
    }
}

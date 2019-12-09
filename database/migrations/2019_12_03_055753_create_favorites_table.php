<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 我的最愛 (成品 與 顧客 多對多樞紐表格)
        Schema::create('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->comment('商品編號');
            $table->unsignedBigInteger('consumer_id')->comment('顧客編號');
            
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('consumer_id')->references('id')->on('consumers');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}

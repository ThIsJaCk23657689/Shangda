<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQuantityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_quantity_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_quantity_id')->comment('對應商品數量表主鍵的外來鍵');
            $table->unsignedBigInteger('material_id')->comment('所減量的原物料編號');
            $table->unsignedInteger('quantity')->comment('所減的數量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_quantity_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 商品的原物料成分表 系指 生產100公斤的商品 所需要的原物料比例為何
        Schema::create('product_recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->comment('商品編號');
            $table->unsignedBigInteger('material_id')->comment('原物料編號');

            // 生產此商品的原料當中所佔的比例 
            $table->double('ratio')->comment('耗材比例');
            $table->double('subcost')->comment('成本價');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_recipes');
    }
}

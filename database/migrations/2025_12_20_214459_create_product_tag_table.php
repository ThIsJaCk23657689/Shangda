<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('product_id')->comment('商品編號');
            $table->unsignedBigInteger('tag_id')->comment('標籤編號');
            $table->timestamps();
            
            // 建立外鍵約束
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            
            // 建立唯一索引，避免重複關聯
            $table->unique(['product_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}

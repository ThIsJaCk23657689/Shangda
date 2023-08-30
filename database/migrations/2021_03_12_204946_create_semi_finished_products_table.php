<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiFinishedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 半成品
        Schema::create('semi_finished_products', function (Blueprint $table) {
            $table->id()->comment('編號');

            $table->string('shownID')->unique()->comment('識別編號');
            $table->string('name')->comment('名稱');
            $table->unsignedInteger('unit')->default(1)->comment('慣用單位；1=>公斤，2=>臺兩，3=>磅');
            $table->string('comment')->nullable()->comment('備註');
            $table->float('stock')->default(0)->comment('目前存貨量');
            $table->float('safeQuantity')->default(0)->comment('安全存貨量');
            $table->string('picture')->nullable()->comment('圖片');

            $table->double('costPrice')->default(0)->comment('成本價格（每單位）');
            // $table->double('profit')->default(0)->comment('利潤');

            // retailPrice = profit + costprice
            // $table->double('retailPrice')->default(0)->comment('零售價格');

            $table->timestamps();
            // $table->softDeletes();
            // $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semi_finished_products');
    }
}

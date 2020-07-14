<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produces', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('商品增量編號');
            // $table->unsignedBigInteger('product_id')->comment('所增量的商品編號');
            $table->unsignedBigInteger('user_id')->comment('員工編號');
            $table->unsignedBigInteger('last_user_id')->comment('員工編號');

            // $table->double('quantity')->comment('所增量的商品數量');
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
        Schema::dropIfExists('produces');
    }
}

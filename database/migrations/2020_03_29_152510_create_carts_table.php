<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('購物車編號');
            $table->unsignedBigInteger('consumer_id')->comment('客戶編號');
            $table->float('totalTaxPrice')->default(0)->comment('購物車商品總價');

            $table->foreign('consumer_id')->references('id')->on('consumers');
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
        Schema::dropIfExists('carts');
    }
}

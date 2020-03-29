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

            // 零售價減去該欄位數值，如果該欄位為負值，則會比原本零售價還更貴哦！
            $table->double('price')->default(0)->comment('折扣價格'); 
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //採購單
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('po_id');//採購單id
            $table->unsignedInteger('s_id');//廠商id
            $table->string('purchaser', 10);//採購人
            $table->string('purchaser_tel', 10);//採購人tel
            $table->string('purchaser_fax', 10);//採購人fax
            $table->dateTime('purchase_time');//採購時間
            $table->dateTime('delivery_time');//交貨時間
            $table->string('delivery_place', 50);//交貨地點
            $table->tinyInteger('payment_type');//付款方式:1.月付 2.隔月 3.付現
            $table->string('remark', 100);//備註

            $table->foreign('s_id')->references('s_id')->on('suppliers')->onDelete('cascade');
            $table->dateTime('created_at');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}

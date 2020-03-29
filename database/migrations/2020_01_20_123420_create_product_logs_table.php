<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            $table->unsignedBigInteger('user_id')->comment('員工編號');
            $table->unsignedBigInteger('product_id')->comment('商品編號');
            // 1.訂單細項新增 2.訂單細項修改 3.訂單細項刪除 4.存貨新增 5.存貨修改 6.存貨刪除 7.確認出貨 8.取消出貨 9.確認付款 10.取消付款
            // 11.確認退貨退款 12.取消退貨退款  13.退貨單細項新增 14.退貨單細項修改 15.退貨單細項刪除
            $table->unsignedInteger('act')->comment('執行動作');
            $table->double('amount')->comment('數量');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 進貨單
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('supplier_id')->comment('供應商編號');
            $table->unsignedBigInteger('user_id')->comment('創建使用者編號');//創建者，不顯示在前端
            $table->unsignedBigInteger('last_user_id')->comment('最後修改使用者編號');//最終修改者，不顯示在前端

            $table->timestamp('expectReceived_at')->comment('預期到貨時間');
            $table->timestamp('paid_at')->nullable()->comment('付款時間');
            $table->timestamp('received_at')->nullable()->comment('到貨時間');

            $table->float('totalPrice')->default(0)->comment('總價');
            $table->string('address')->nullable()->default('苗栗縣竹南鎮國泰路43號')->comment('送貨地址');
            $table->integer('taxType')->default(1)->comment('稅別'); //1~6
            $table->integer('invoiceType')->default(1)->comment('發票類型'); //1~5
            $table->string('shown_id')->unique()->comment('顯示ID'); //P西元年+今日第幾個單
            $table->string('comment')->nullable()->comment('備註');

            $table->timestamps();
            // $table->softDeletes();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');
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

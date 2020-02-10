<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            $table->unsignedBigInteger('consumers_id')->comment('客戶編號');
            $table->unsignedBigInteger('user_id')->comment('員工編號');
            $table->unsignedBigInteger('last_user_id')->comment('最後修改使用者編號');//最終修改者，不顯示在前端

            $table->timestamp('expectPay_at')->nullable()->comment('預計付款日');
            $table->timestamp('paid_at')->nullable()->comment('實際付款日');
            $table->timestamp('expectDeliver_at')->nullable()->comment('預計出貨日');
            $table->timestamp('delivered_at')->nullable()->comment('實際出貨日');
            $table->timestamp('makeInvoice_at')->nullable()->comment('發票列印日');

            $table->float('piadAmount')->default(0)->comment('訂單已付額');
            $table->float('unpiadAmount')->default(0)->comment('訂單未付額');
            $table->float('totalPrice')->default(0)->comment('訂單未稅額');
            $table->float('taxPrice')->default(0)->comment('訂單稅額');
            $table->float('totalTaxPrice')->default(0)->comment('訂單總價');

            $table->text('comment')->nullable()->comment('備註');
            $table->integer('taxType')->default(1)->comment('稅別'); //1~6
            $table->integer('invoiceType')->default(1)->comment('發票類型'); //1~5
            $table->string('address')->nullable()->comment('地址');
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
        Schema::dropIfExists('sale_orders');
    }
}

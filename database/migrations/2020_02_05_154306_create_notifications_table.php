<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('job_title_id')->comment('職稱編號');
            // 0 => 未分類
            // 1 => (新建銷貨單通知); 2 => (原物料庫存低於安全庫存通知); 3 => (月結日期到結帳通知);
            // 4 => (原物料進貨單逾期未到貨通知)； 5 => (預計出貨未出貨通知)； 6 => (商品庫存低於安全庫存通知)
            // 7 => (通知月結客戶已確認退款)
            $table->integer('type')->default(0)->comment('通知類型');
            // 0 => 未讀; 1 => 已讀
            $table->integer('status')->default(0)->comment('通知狀態');
            $table->text('comment')->nullable()->comment('通知內容');
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
        Schema::dropIfExists('notifications');
    }
}

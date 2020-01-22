<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('員工編號');
            $table->unsignedBigInteger('material_id')->comment('原物料編號');
            //1.進貨新增 2.進貨修改 3.進貨刪除 4.原料使用 5.原料使用修改 6.原料使用刪除
            $table->unsignedBigInteger('act')->comment('執行動作'); 
            $table->double('amount')->comment('數量');
            $table->softDeletes();
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
        Schema::dropIfExists('material_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 主要五個原料的資料表
        Schema::create('basic_materials', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            $table->string('name', 100)->comment('名稱');
            $table->float('price')->default(0)->comment('價格');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_materials');
    }
}

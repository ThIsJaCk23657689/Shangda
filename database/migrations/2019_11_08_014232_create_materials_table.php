<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //原料
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('m_id');
            $table->string('material_name', 20);//原料名稱
            $table->integer('stock');//存量(kg)
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
        Schema::dropIfExists('materials');
    }
}

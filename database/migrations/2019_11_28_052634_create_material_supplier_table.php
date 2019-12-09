<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 原物料與供應商 => 多對多樞紐表
        Schema::create('material_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('material_id')->comment('原物料編號');
            $table->unsignedBigInteger('supplier_id')->comment('供應商編號');

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_supplier');
    }
}

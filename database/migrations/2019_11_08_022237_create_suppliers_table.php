<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //供應商
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('s_id');
            $table->string('supplier_name', 20);//廠商名稱
            $table->string('contact_person', 20);//聯絡人
            $table->string('tel', 20);//電話
            $table->string('fax', 20);//傳真
            $table->string('address', 20);//地址
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
        Schema::dropIfExists('suppliers');
    }
}

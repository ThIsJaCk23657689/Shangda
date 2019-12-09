<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('id')->on('discount');
            $table->string('name',100);
            $table->string('shortName',100)->nullable();
            $table->string('act',30)->unique();
            $table->string('pwd');
            $table->string('taxID')->nullable()->unique();  //統編
            $table->string('idNumber')->nullable()->unique();//身分證

            $table->rememberToken();
            $table->string('inCharge1',50);                 //主要聯絡人資訊
            $table->string('tel1',25);                      
            $table->string('email1',100)->nullable();
            $table->string('inCharge2',50)->nullable();     //次要聯絡人資訊
            $table->string('tel2',25)->nullable();
            $table->string('email2',100)->nullable();
            $table->string('tax',25)->nullable();

            $table->integer('monthlyCheckDate')->nullable();//月結日
            $table->float('uncheckedAmount')->default(0);   //未沖帳總額
            $table->float('totalConsumption')->default(0);  //總消費額
            $table->string('companyAddress');
            $table->string('deliveryAddress');
            $table->string('invoiceAddress');
            $table->text('comment')->nullable();
            
            $table->softDeletes();                          //黑名單
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
        Schema::dropIfExists('consumers');
    }
}

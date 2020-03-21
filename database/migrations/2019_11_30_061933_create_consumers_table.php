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
        // 顧客資料表 (廠商)
        Schema::create('consumers', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            // $table->unsignedBigInteger('discount_id')->comment('折扣編號');

            $table->string('shownID')->nullable()->unique()->comment('識別編號');
            $table->string('name')->comment('名稱');
            $table->string('act', 30)->unique()->comment('帳號');
            $table->string('pwd', 30)->comment('密碼');
            $table->string('taxID', 8)->nullable()->unique()->comment('統一編號');
            $table->string('idNumber', 10)->nullable()->unique()->comment('身分證');
            $table->string('tax', 25)->nullable()->comment('傳真');

            $table->string('inCharge1', 50)->comment('聯絡人名稱1');                 //主要聯絡人資訊
            $table->string('tel1', 25)->comment('聯絡人電話1');
            $table->string('email1', 100)->nullable()->comment('聯絡人信箱1');
            $table->string('inCharge2', 50)->nullable()->comment('聯絡人名稱2');     //次要聯絡人資訊
            $table->string('tel2', 25)->nullable()->comment('聯絡人電話2');
            $table->string('email2', 100)->nullable()->comment('聯絡人信箱2');

            $table->unsignedInteger('monthlyCheckDate')->nullable()->default(0)->comment('月結日');
            $table->float('uncheckedAmount')->default(0)->comment('未沖帳總額'); //未結帳金額 + ；超付金額 -
            $table->float('totalConsumption')->default(0)->comment('總消費額');

            $table->string('companyAddress')->comment('公司地址');
            $table->string('deliveryAddress')->comment('送貨地址');
            $table->string('invoiceAddress')->comment('發票地址');
            $table->string('comment')->nullable()->comment('備註');

            // 預設為0，代表是顧客自己創建(註冊) | 如果為1代表為管理者所創建。
            $table->boolean('account_type')->nullable()->default(0)->comment('帳號類型');

            // 負責業務預設為Admin(就是不指定) 注意負責業務 不等於 創建此客戶資料的員工 特別注意。
            $table->unsignedBigInteger('user_id')->default(1)->comment('負責業務');

            $table->softDeletes(); //黑名單
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('discount_id')->references('id')->on('discount');
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

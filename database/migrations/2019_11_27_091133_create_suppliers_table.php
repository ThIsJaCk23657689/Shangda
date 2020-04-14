<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 供應商
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');

            $table->string('name', 100)->comment('名稱');
            $table->string('shortName', 100)->nullable()->comment('簡稱');
            $table->string('taxId', 8)->nullable()->unique()->comment('統一編號');

            $table->string('tel', 20)->nullable()->comment('電話');
            $table->string('tax', 20)->nullable()->comment('傳真');

            $table->string('comment')->nullable()->comment('備註');

            $table->string('operator_name_1', 50)->comment('聯絡窗口1 - 姓名');
            $table->string('operator_tel_1', 20)->nullable()->comment('聯絡窗口1 - 電話');
            $table->string('operator_phone_1', 10)->nullable()->comment('聯絡窗口1 - 手機');
            $table->string('operator_email_1', 100)->nullable()->comment('聯絡窗口1 - 信箱');
            $table->string('operator_name_2', 50)->nullable()->comment('聯絡窗口2 - 姓名');
            $table->string('operator_tel_2', 20)->nullable()->comment('聯絡窗口2 - 電話');
            $table->string('operator_phone_2', 10)->nullable()->comment('聯絡窗口2 - 手機');
            $table->string('operator_email_2', 100)->nullable()->comment('聯絡窗口2 - 信箱');

            $table->string('companyAddress_zipcode', 5)->nullable()->comment('公司地址 - 郵遞區號');
            $table->string('companyAddress_county', 10)->nullable()->comment('公司地址 - 縣市');
            $table->string('companyAddress_district', 10)->nullable()->comment('公司地址 - 鄉鎮');
            $table->string('companyAddress_others')->nullable()->comment('公司地址 - 其他');

            // ==================== 付款資訊 ====================
            $table->string('bank_name', 50)->nullable()->comment('銀行名稱');
            $table->string('bank_branch_name', 50)->nullable()->comment('分行名稱');
            $table->string('bank_code', 50)->nullable()->comment('銀行通匯代號');
            $table->string('bank_account', 50)->nullable()->comment('帳號');
            $table->string('bank_account_name', 50)->nullable()->comment('戶名');
            
            // 現金、匯款、支票、信用卡
            $table->string('payment_method', 1)->nullable()->comment('付款方式');
            // 0 => 貨到付款、1 ~ 31 => 月結日
            $table->unsignedInteger('monthlyCheckDate')->default(0)->comment('月結日');

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
        Schema::dropIfExists('suppliers');
    }
}

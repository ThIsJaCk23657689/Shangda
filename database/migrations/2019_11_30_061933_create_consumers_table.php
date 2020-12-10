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
        // 顧客資料表
        Schema::create('consumers', function (Blueprint $table) {

            // ==================== 通用資料 (個人帳號與法人帳號都通用之資料) ====================
            $table->bigIncrements('id')->comment('編號');
            $table->string('account', 30)->unique()->comment('帳號');
            $table->string('password')->comment('密碼');
            $table->string('name', 100)->comment('姓名 or 公司名稱');
            $table->string('shortName', 100)->nullable()->comment('簡稱');
            $table->boolean('gender')->nullable()->comment('性別');
            // $table->string('idNumber', 10)->nullable()->unique()->comment('身分證 or 公司負責人身分證');
            $table->string('email', 100)->unique()->comment('信箱 or 公司信箱');
            $table->string('lineID', 100)->nullable()->comment('Line ID');

            $table->unsignedInteger('monthlyCheckDate')->default(0)->comment('月結日');
            $table->float('uncheckedAmount')->default(0)->comment('未沖帳總額'); // 未結帳金額 - 超付金額
            $table->float('totalConsumption')->default(0)->comment('總消費額');

            // 地址
            $table->string('address_zipcode', 5)->nullable()->comment('地址 or 公司地址 - 郵遞區號');
            $table->string('address_county', 10)->nullable()->comment('地址 or 公司地址 - 縣市');
            $table->string('address_district', 10)->nullable()->comment('地址 or 公司地址 - 鄉鎮');
            $table->string('address_others')->nullable()->comment('地址 or 公司地址 - 其他');

            $table->boolean('policy_agreement')->default(1)->comment('是否同意會員合約與隱私政策');
            $table->string('comment')->nullable()->comment('備註');
            // ==================== 通用資料 (個人帳號與法人帳號都通用之資料) ====================




            // ==================== 個人帳號資料 ====================
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('phone', 10)->nullable()->comment('手機');
            // ==================== 個人帳號資料 ====================




            // ==================== 法人帳號資料 ====================
            $table->string('branch', 50)->nullable()->comment('分店名');
            $table->string('principal', 100)->nullable()->comment('公司負責人名稱');
            $table->string('taxID', 8)->nullable()->comment('統一編號');
            $table->string('tel', 20)->nullable()->comment('電話 or 公司電話');
            $table->string('tax', 20)->nullable()->comment('公司傳真');

            $table->string('operator_name_1')->nullable()->comment('聯絡人名稱1');
            $table->string('operator_tel_1', 20)->nullable()->comment('聯絡人電話1');
            $table->string('operator_phone_1', 20)->nullable()->comment('聯絡人手機1');
            $table->string('operator_email_1', 100)->nullable()->comment('聯絡人信箱1');
            $table->string('operator_name_2')->nullable()->comment('聯絡人名稱2');
            $table->string('operator_tel_2', 20)->nullable()->comment('聯絡人電話2');
            $table->string('operator_phone_2', 20)->nullable()->comment('聯絡人手機2');
            $table->string('operator_email_2', 100)->nullable()->comment('聯絡人信箱2');

            $table->string('deliveryAddress_zipcode', 5)->nullable()->comment('送貨地址 - 郵遞區號');
            $table->string('deliveryAddress_county', 10)->nullable()->comment('送貨地址 - 縣市');
            $table->string('deliveryAddress_district', 10)->nullable()->comment('送貨地址 - 鄉鎮');
            $table->string('deliveryAddress_others')->nullable()->comment('送貨地址 - 其他');
            // ==================== 法人帳號資料 ====================




            // 預設為0，代表是個人帳號 | 如果為1代表是法人帳號。
            $table->boolean('account_type')->default(0)->comment('帳號類型');

            // 預設為0，代表是顧客自己創建(註冊) | 如果為1代表為管理者所創建。
            $table->boolean('who_created')->default(0)->comment('創建類型');

            // 負責業務預設為Admin(就是不指定) 注意負責業務 不等於 創建此客戶資料的員工 特別注意。
            $table->unsignedBigInteger('user_id')->default(1)->comment('負責業務');

            $table->softDeletes(); //黑名單
            $table->rememberToken();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 員工資料表
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');

            // 4.Admin、3.廠長、2.業務、1.廠務
            $table->unsignedBigInteger('job_title_id')->default(1)->comment('職稱編號');

            $table->string('name')->comment('名稱');
            $table->string('email')->unique()->comment('信箱');
            $table->timestamp('email_verified_at')->nullable()->comment('信箱驗證');
            $table->string('password')->comment('密碼');
            $table->boolean('gender')->nullable()->comment('性別');
            $table->date('birthday')->nullable()->comment('生日');

            $table->string('address_zipcode', 5)->nullable()->comment('地址 - 郵遞區號');
            $table->string('address_county', 10)->nullable()->comment('地址 - 縣市');
            $table->string('address_district', 10)->nullable()->comment('地址 - 鄉鎮');
            $table->string('address_others')->nullable()->comment('地址 - 其他');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

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
            $table->unsignedBigInteger('job_title_id')->default(1)->comment('職稱編號');

            $table->string('name')->comment('名稱');
            $table->string('email')->unique()->comment('信箱');
            $table->timestamp('email_verified_at')->nullable()->comment('信箱驗證');
            $table->string('password')->comment('密碼');
            $table->boolean('gender')->comment('性別');
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
        Schema::dropIfExists('users');
    }
}

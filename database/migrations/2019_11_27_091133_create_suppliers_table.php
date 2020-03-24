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

            $table->string('tel', 25)->nullable()->comment('電話');
            $table->string('tax', 25)->nullable()->comment('傳真');

            $table->string('inCharge1', 50)->comment('負責人名稱1');
            $table->string('tel1', 25)->comment('負責人電話1');
            $table->string('email1', 100)->nullable()->comment('負責人信箱1');
            $table->string('inCharge2', 50)->nullable()->comment('負責人名稱2');
            $table->string('tel2', 25)->nullable()->comment('負責人電話2');
            $table->string('email2', 100)->nullable()->comment('負責人信箱2');

            $table->string('companyAddress_zipcode', 5)->nullable()->comment('公司地址 - 郵遞區號');
            $table->string('companyAddress_county', 10)->nullable()->comment('公司地址 - 縣市');
            $table->string('companyAddress_district', 10)->nullable()->comment('公司地址 - 鄉鎮');
            $table->string('companyAddress_others')->nullable()->comment('公司地址 - 其他');

            $table->text('comment')->nullable()->comment('備註');
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

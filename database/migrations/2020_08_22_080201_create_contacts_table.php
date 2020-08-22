<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->comment('感興趣的商品編號');
            $table->string('name')->comment('聯絡名稱');
            $table->string('phone', 20)->comment('電話號碼');
            $table->boolean('gender')->comment('性別');
            $table->string('email')->nullable()->comment('信箱');
            $table->string('lineID')->nullable()->comment('Line ID');
            $table->string('comment')->nullable()->comment('備註');
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
        Schema::dropIfExists('contacts');
    }
}

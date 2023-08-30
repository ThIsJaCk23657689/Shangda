<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id()->comment('編號');
            $table->unsignedBigInteger('last_update_user_id')->nullable()->comment('最後更新使用者編號');
            $table->string('title')->comment('標題');
            $table->text('content')->comment('內文');
            $table->string('cover_image')->nullable()->comment('封面圖片');
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
        Schema::dropIfExists('announcements');
    }
}

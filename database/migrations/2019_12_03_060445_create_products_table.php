<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 成品資料表
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('編號');
            $table->unsignedBigInteger('category_id')->comment('商品類別編號');

            $table->string('name', 100)->comment('名稱');
            $table->string('shortName',100)->nullable()->comment('簡稱');
            $table->string('internationalNum', 100)->nullable()->comment('國際條碼');

            $table->double('fundamentalPrice')->default(0)->comment('基礎價格');
            $table->double('retailPrice')->default(0)->comment('零售價格');
            $table->double('materialCoefficient1')->default(0)->comment('原料1比重');
            $table->double('materialCoefficient2')->default(0)->comment('原料2比重');
            $table->double('materialCoefficient3')->default(0)->comment('原料3比重');
            $table->double('materialCoefficient4')->default(0)->comment('原料4比重');
            $table->double('materialCoefficient5')->default(0)->comment('原料5比重');
            // retailPrice = [(漲幅價差) * materialCoefficient] +  fundamentalPrice

            $table->string('picture')->nullable()->comment('圖片');
            $table->text('intro')->nullable()->comment('簡介');
            $table->text('specification')->nullable()->comment('規格');
            $table->string('unit', 100)->nullable()->comment('慣用單位');
            $table->unsignedInteger('quantity')->default(0)->comment('剩餘庫存');
            $table->unsignedInteger('safeQuantity')->default(0)->comment('安全庫存');

            $table->text('comment')->nullable()->comment('備註');
            $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

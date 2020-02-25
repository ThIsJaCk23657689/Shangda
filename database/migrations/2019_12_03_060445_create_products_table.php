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

            $table->string('shownID')->unique()->comment('識別編號');
            $table->boolean('isManualID')->default('0')->comment('是否為手動編號');
            $table->string('name')->comment('名稱');
            $table->boolean('isManualNamed')->default('0')->comment('是否為手動命名');
            $table->string('internationalNum', 20)->nullable()->comment('國際條碼');
            $table->string('specification')->nullable()->comment('商品規格');
            $table->string('color')->nullable()->comment('商品顏色或花樣');
            $table->boolean('isCustomize')->default('0')->comment('是否為客製化商品');
            $table->boolean('isPublic')->default('0')->comment('是否公開顯示在前台');
            $table->boolean('showPrice')->default('0')->comment('是否公開價格');

            // length、width和chamfer 單位都是公分，如果值為0將不顯示。
            $table->integer('length')->nullable()->default(0)->comment('商品長度');
            $table->integer('width')->nullable()->default(0)->comment('商品寬度');
            $table->integer('chamfer')->nullable()->default(0)->comment('商品折角');

            // weight 單位是兩，如果值為0將不顯示。
            $table->integer('weight')->default(0)->comment('商品重量');

            // qty_per_pack 單位取決於unit，如果unit為NUL代表此商品沒有【件】。
            // 例如 商品【外袋】，unit會是NULL且qty_per_pack為0。
            // 商品庫存為1時，代表此商品外袋庫存只剩下1個。
            $table->integer('qty_per_pack')->default(0)->comment('每件數量');

            // unit 可能的值為： package：包, kg：公斤, roll：捲 和 NULL：個 
            $table->string('unit', 10)->nullable()->comment('慣用單位');

            $table->text('intro')->nullable()->comment('簡介');
            // 這邊的quantity指的不是【件】的庫存，單位會是unit所選的慣用單位。
            $table->unsignedInteger('quantity')->default(0)->comment('剩餘庫存');
            $table->unsignedInteger('safeQuantity')->default(0)->comment('安全庫存');
            $table->text('comment')->nullable()->comment('備註');

            $table->double('costprice')->default(0)->comment('成本價格'); 
            $table->double('profit')->default(0)->comment('利潤'); 
            
            // retailPrice = profit + costprice
            $table->double('retailPrice')->default(0)->comment('零售價格');
            

            $table->timestamps();
            $table->softDeletes();
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

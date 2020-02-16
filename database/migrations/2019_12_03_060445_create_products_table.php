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
            $table->string('name')->comment('名稱');
            $table->boolean('isManualNamed')->nullable()->default('0')->comment('是否為手動命名');
            $table->string('internationalNum', 50)->nullable()->comment('國際條碼');
            $table->string('picture')->nullable()->comment('圖片');
            $table->string('specification')->nullable()->comment('商品規格');
            $table->string('color')->nullable()->comment('商品顏色或花樣');

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

            $table->double('fundamentalPrice')->default(0)->comment('基礎價格'); 
            $table->double('materialCoefficient1')->default(0)->comment('原料1比重');
            $table->double('materialCoefficient2')->default(0)->comment('原料2比重');
            $table->double('materialCoefficient3')->default(0)->comment('原料3比重');
            $table->double('materialCoefficient4')->default(0)->comment('原料4比重');
            $table->double('materialCoefficient5')->default(0)->comment('原料5比重');
            $table->double('retailPrice')->default(0)->comment('零售價格');
            // retailPrice = [(漲幅價差) * materialCoefficient] +  fundamentalPrice

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

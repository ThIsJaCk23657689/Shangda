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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name',100);
            $table->string('shortName',100)->nullable();
            $table->float('fundamentalPrice')->default(0);
            $table->float('retailPrice')->default(0);
            $table->float('materialCoefficient1')->default(0);
            $table->float('materialCoefficient2')->default(0);
            $table->float('materialCoefficient3')->default(0);
            $table->float('materialCoefficient4')->default(0);
            $table->float('materialCoefficient5')->default(0);

            $table->text('comment')->nullable();
            $table->string('internationalNum',100)->nullable();
            $table->string('unit',100)->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('safeQuantity')->default(0);
            $table->string('picture')->nullable();
            $table->text('intro')->default('該產品目前沒有產品介紹');
            $table->text('specification')->default('該產品目前沒有產品規格');
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
        Schema::dropIfExists('products');
    }
}

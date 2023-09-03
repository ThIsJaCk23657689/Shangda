<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionTimeInSalesOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->timestamp('transaction_at')->nullable()->after('makeInvoice_at')->comment('實際交易日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropColumn('transaction_at');
        });
    }
}

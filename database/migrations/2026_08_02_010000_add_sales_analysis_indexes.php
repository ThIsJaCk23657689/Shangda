<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalesAnalysisIndexes extends Migration
{
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->index(['confirmStatus', 'status', 'transaction_at', 'consumer_id'], 'sales_orders_analysis_status_date_consumer_index');
        });
        Schema::table('sales_order_details', function (Blueprint $table) {
            $table->index(['product_id', 'sales_order_id'], 'sales_order_details_product_order_index');
        });
    }

    public function down()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropIndex('sales_orders_analysis_status_date_consumer_index');
        });
        Schema::table('sales_order_details', function (Blueprint $table) {
            $table->dropIndex('sales_order_details_product_order_index');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerSalesReportIndexesToSalesOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->index(['consumer_id', 'status', 'confirmStatus', 'transaction_at'], 'sales_orders_customer_transaction_report_index');
            $table->index(['consumer_id', 'delivered_at'], 'sales_orders_customer_delivered_report_index');
            $table->index(['consumer_id', 'paid_at'], 'sales_orders_customer_paid_report_index');
            $table->index(['consumer_id', 'created_at'], 'sales_orders_customer_created_report_index');
        });
    }

    public function down()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropIndex('sales_orders_customer_transaction_report_index');
            $table->dropIndex('sales_orders_customer_delivered_report_index');
            $table->dropIndex('sales_orders_customer_paid_report_index');
            $table->dropIndex('sales_orders_customer_created_report_index');
        });
    }
}

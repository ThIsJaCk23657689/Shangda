<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDashboardReceivableIndex extends Migration
{
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->index(
                ['confirmStatus', 'status', 'expectPay_at', 'consumer_id', 'unpaidAmount'],
                'sales_orders_dashboard_receivable_index'
            );
        });
    }

    public function down()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropIndex('sales_orders_dashboard_receivable_index');
        });
    }
}

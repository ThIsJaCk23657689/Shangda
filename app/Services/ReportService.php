<?php

namespace App\Services;

use App\SalesOrder as SalesOrderEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Consumer as ConsumerEloquent;
use URL;
use Auth;
use Carbon\Carbon;
use DB;

class ReportService extends BaseService
{
    public function salesReportYear($request){
        // SELECT MONTH(sales_orders.created_at) as `month`, sales_orders.consumer_id , consumers.name, SUM(sales_orders.totalTaxPrice)
        // FROM sales_orders RIGHT JOIN consumers ON sales_orders.consumer_id = consumers.id
        // WHERE sales_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' GROUP BY sales_orders.consumer_id, `month`

        $type = $request->type ?? 1;  // 1.'依客戶別', 2.'依商品別'
        $year = $request->year ?? Carbon::now()->year;  // 預設 今年

        $consumers = ConsumerEloquent::get();

        $salesOrders = DB::table('sales_orders')->select(DB::raw('sales_orders.consumer_id as consumer_id') ,DB::raw('MONTH(sales_orders.created_at) as month'), 'consumers.name', DB::raw('SUM(totalTaxPrice) as total_sales'))
        ->rightJoin('consumers', 'consumers.id', '=', 'sales_orders.consumer_id')->whereBetween('sales_orders.created_at', [$year.'-01-01', $year.'-12-31'])
        ->groupByRaw('sales_orders.consumer_id, month')->get();


        $result = [];

        foreach($consumers as $consumer){
            $c_arr = [$consumer->name, 0, 0, 0 , 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $total_price = 0;
            foreach($salesOrders as $salesOrder){
                if($salesOrder->consumer_id == $consumer->id){
                    $c_arr[$salesOrder->month]=$salesOrder->total_sales;
                    $total_price += $salesOrder->total_sales;
                }
            }
            $c_arr[13] = $total_price;
            array_push($result, $c_arr);
        }

        return [
            'status' => 200,
            'result' => $result,
            'year' => $year
        ];
    }
}

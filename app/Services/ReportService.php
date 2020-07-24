<?php

namespace App\Services;

use App\SalesOrder as SalesOrderEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Consumer as ConsumerEloquent;
use App\Supplier as SupplierEloquent;
use Carbon\Carbon;
use Auth;
use DB;

class ReportService extends BaseService
{
    public function salesReportYear($request)
    {
        // SELECT MONTH(sales_orders.created_at) as `month`, sales_orders.consumer_id , consumers.name, SUM(sales_orders.totalTaxPrice)
        // FROM sales_orders RIGHT JOIN consumers ON sales_orders.consumer_id = consumers.id
        // WHERE sales_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' GROUP BY sales_orders.consumer_id, `month`

        $type = $request->type ?? 1;  // 1.'依客戶別', 2.'依商品別'
        $year = $request->year ?? Carbon::now()->year;  // 預設 今年
        $orderby = $request->orderby ?? 1; // 1.'升序', 2.'降序'

        $consumers = ConsumerEloquent::get();
        $salesOrders = DB::table('sales_orders')
            ->select(
                DB::raw('sales_orders.consumer_id as consumer_id'),
                DB::raw('MONTH(sales_orders.created_at) as month'),
                'consumers.name',
                DB::raw('SUM(totalTaxPrice) as total_sales')
            )->rightJoin('consumers', 'consumers.id', '=', 'sales_orders.consumer_id')
            ->whereBetween('sales_orders.created_at', [
                $year . '-01-01',
                $year . '-12-31'
            ])->groupByRaw('sales_orders.consumer_id, month')->get();


        $result = [];
        foreach ($consumers as $consumer) {
            $c_arr = [$consumer->name, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $total_price = 0;
            foreach ($salesOrders as $salesOrder) {
                if ($salesOrder->consumer_id == $consumer->id) {
                    $c_arr[$salesOrder->month] = $salesOrder->total_sales;
                    $total_price += $salesOrder->total_sales;
                }
            }
            $c_arr[13] = $total_price;
            array_push($result, $c_arr);
        }

        $result = collect($result);
        if($orderby == 1){
            $sorted = $result->sortBy(function ($row, $key) {
                return $row[13];
            });
        }else{
            $sorted = $result->sortByDesc(function ($row, $key) {
                return $row[13];
            });
        }
        $result = $sorted->values()->all();

        return [
            'status' => 200,
            'result' => $result,
        ];
    }

    public function purchaseReportYear($request){

        // SELECT purchase_orders.supplier_id as supplier_id, MONTH(purchase_orders.created_at) as month, suppliers.name, SUM(totalPrice) as total_purchase 
        // FROM purchase_orders RIGHT JOIN suppliers ON suppliers.id = purchase_orders.supplier_id 
        // WHERE purchase_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' 
        // GROUP BY purchase_orders.supplier_id, month;

        $type = $request->type ?? 1;  // 1.'依客戶別', 2.'依商品別'
        $year = $request->year ?? Carbon::now()->year;  // 預設 今年
        $orderby = $request->orderby ?? 1; // 1.'升序', 2.'降序'

        $suppliers = SupplierEloquent::get();
        $purchaseOrders = DB::table('purchase_orders')
            ->select(
                DB::raw('purchase_orders.supplier_id as supplier_id'),
                DB::raw('MONTH(purchase_orders.created_at) as month'),
                'suppliers.name',
                DB::raw('SUM(totalPrice) as total_purchase')
            )->rightJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->whereBetween('purchase_orders.created_at', [
                $year . '-01-01',
                $year . '-12-31'
            ])->groupByRaw('purchase_orders.supplier_id, month')->get();


        $result = [];
        foreach ($suppliers as $supplier) {
            $c_arr = [$supplier->name, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $total_price = 0;
            foreach ($purchaseOrders as $purchaseOrder) {
                if ($purchaseOrder->supplier_id == $supplier->id) {
                    $c_arr[$purchaseOrder->month] = $purchaseOrder->total_purchase;
                    $total_price += $purchaseOrder->total_purchase;
                }
            }
            $c_arr[13] = $total_price;
            array_push($result, $c_arr);
        }

        $result = collect($result);
        if($orderby == 1){
            $sorted = $result->sortBy(function ($row, $key) {
                return $row[13];
            });
        }else{
            $sorted = $result->sortByDesc(function ($row, $key) {
                return $row[13];
            });
        }
        $result = $sorted->values()->all();

        return [
            'status' => 200,
            'result' => $result,
        ];
    }
}

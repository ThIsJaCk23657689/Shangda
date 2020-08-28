<?php

namespace App\Services;

use App\SalesOrder as SalesOrderEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Consumer as ConsumerEloquent;
use App\Supplier as SupplierEloquent;
use App\Product as ProductEloquent;
use App\Material as MaterialEloquent;
use Carbon\Carbon;
use Auth;
use DB;

class ReportService extends BaseService
{
    public function salesReportYear($request)
    {
        // 依客戶別SQL
        // SELECT MONTH(sales_orders.created_at) as `month`, sales_orders.consumer_id , consumers.name, SUM(sales_orders.totalTaxPrice)
        // FROM sales_orders RIGHT JOIN consumers ON sales_orders.consumer_id = consumers.id
        // WHERE sales_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' GROUP BY sales_orders.consumer_id, `month`

        // 依商品別SQL
        // SELECT products.id,products.name, MONTH(sales_orders.created_at) as `month`, SUM(sales_order_details.subTotal) FROM
        // (sales_orders RIGHT JOIN sales_order_details ON sales_orders.id = sales_order_details.sales_order_id)
        // RIGHT JOIN products ON sales_order_details.product_id = products.id
        // WHERE sales_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' GROUP BY sales_order_details.product_id, `month`

        $type = $request->type ?? 1;  // 1.'依客戶別', 2.'依商品別'
        $year = $request->year ?? Carbon::now()->year;  // 預設 今年
        $orderby = $request->orderby ?? 1; // 1.'升序', 2.'降序'

        // 依客戶別
        if($type == 1){
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
        }else{
            // 依商品別
            // 依商品別SQL
            // SELECT products.id,products.name, MONTH(sales_orders.created_at) as `month`, SUM(sales_order_details.subTotal) FROM
            // (sales_orders RIGHT JOIN sales_order_details ON sales_orders.id = sales_order_details.sales_order_id)
            // RIGHT JOIN products ON sales_order_details.product_id = products.id
            // WHERE sales_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31' GROUP BY sales_order_details.product_id, `month`
            $products = ProductEloquent::get();
            $salesOrders = DB::table('sales_orders')
            ->select(
                DB::raw('products.id as p_id'), 'products.name',
                DB::raw('SUM(sales_order_details.subTotal) as subTotal'),
                DB::raw('MONTH(sales_orders.created_at) as month'),
            )->rightJoin('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->rightJoin('products', 'products.id', '=', 'sales_order_details.product_id')
            ->whereBetween('sales_orders.created_at', [
                $year . '-01-01',
                $year . '-12-31'
            ])->groupByRaw('sales_order_details.product_id, month')->get();

            $result = [];
            foreach ($products as $product) {
                $c_arr = [$product->name, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $total_price = 0;
                foreach ($salesOrders as $salesOrder) {
                    if ($salesOrder->p_id == $product->id) {
                        $c_arr[$salesOrder->month] = $salesOrder->subTotal;
                        $total_price += $salesOrder->subTotal;
                    }
                }
                $c_arr[13] = $total_price;
                array_push($result, $c_arr);
            }
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

        // 依客戶別SQL
        // SELECT purchase_orders.supplier_id as supplier_id, MONTH(purchase_orders.created_at) as month, suppliers.name, SUM(totalPrice) as total_purchase
        // FROM purchase_orders RIGHT JOIN suppliers ON suppliers.id = purchase_orders.supplier_id
        // WHERE purchase_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31'
        // GROUP BY purchase_orders.supplier_id, month;

        // 依原料別SQL
        // SELECT materials.id,materials.name, MONTH(purchase_orders.created_at) as `month`, SUM(purchase_order_details.subTotal) FROM
        // (purchase_orders RIGHT JOIN purchase_order_details ON purchase_orders.id = purchase_order_details.purchaseOrder_id)
        // RIGHT JOIN materials ON purchase_order_details.material_id = materials.id WHERE purchase_orders.created_at BETWEEN '2020-01-01' AND '2020-12-31'
        // GROUP BY purchase_order_details.material_id, `month`

        $type = $request->type ?? 1;  // 1.'依客戶別', 2.'依商品別'
        $year = $request->year ?? Carbon::now()->year;  // 預設 今年
        $orderby = $request->orderby ?? 1; // 1.'升序', 2.'降序'

        // 依客戶別
        if($type == 1){
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
        }else{
            // 依原料別
            $materials = MaterialEloquent::get();
            $purchaseOrders = DB::table('purchase_orders')
            ->select(
                DB::raw('materials.id as m_id'), 'materials.name',
                DB::raw('SUM(purchase_order_details.subTotal) as subTotal'),
                DB::raw('MONTH(purchase_orders.created_at) as month'),
            )->rightJoin('purchase_order_details', 'purchase_orders.id', '=', 'purchase_order_details.purchaseOrder_id')
            ->rightJoin('materials', 'materials.id', '=', 'purchase_order_details.material_id')
            ->whereBetween('purchase_orders.created_at', [
                $year . '-01-01',
                $year . '-12-31'
            ])->groupByRaw('purchase_order_details.material_id, month')->get();

            $result = [];
            foreach ($materials as $material) {
                $c_arr = [$material->name, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $total_price = 0;
                foreach ($purchaseOrders as $purchaseOrder) {
                    if ($purchaseOrder->m_id == $material->id) {
                        $c_arr[$purchaseOrder->month] = $purchaseOrder->subTotal;
                        $total_price += $purchaseOrder->subTotal;
                    }
                }
                $c_arr[13] = $total_price;
                array_push($result, $c_arr);
            }
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

    public function salesReportDaily($request){

        // 依商品別 SQL
        // SELECT products.id,products.name, DATE(sales_orders.created_at) as `date`, SUM(sales_order_details.subTotal) FROM
        // (sales_orders RIGHT JOIN sales_order_details ON sales_orders.id = sales_order_details.sales_order_id)
        // RIGHT JOIN products ON sales_order_details.product_id = products.id
        // WHERE sales_orders.created_at BETWEEN '2020-06-15' AND '2020-07-31' GROUP BY  products.id, `date`
        // ORDER BY `date` ASC , products.id ASC

        // 依客戶別 SQL
        // SELECT consumers.id,consumers.name, DATE(sales_orders.created_at) as `date`, SUM(sales_orders.totalPrice) FROM sales_orders
        // RIGHT JOIN consumers ON sales_orders.consumer_id = consumers.id
        // WHERE sales_orders.created_at BETWEEN '2020-06-15' AND '2020-07-31' GROUP BY  consumers.id, `date`
        // ORDER BY `date` ASC

        $type = $request->type;  // 1.'依供應商別', 2.'依原料別'
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $start_date.' 00:00')->toDateTimeString();
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $end_date.'23:59')->toDateTimeString();

        if($type == 1){
            // 依客戶別
            $salesOrders = DB::table('sales_orders')
            ->select(
                DB::raw('consumers.id as c_id'), 'consumers.name',
                DB::raw('SUM(sales_orders.totalPrice) as subTotal'),
                DB::raw('DATE(sales_orders.created_at) as date'))
            ->rightJoin('consumers', 'consumers.id', '=', 'sales_orders.consumer_id')
            ->whereBetween('sales_orders.created_at', [
                $start_date,
                $end_date
            ])->groupByRaw('consumers.id, date')->orderBy('date', 'asc')->get();

            $result = collect($salesOrders);
            $result = $result->groupBy('date');

            return [
                'status' => 200,
                'result' => $result,
            ];

        }else{
            // 依商品別
            // SELECT products.id,products.name, DATE(sales_orders.created_at) as `date`, SUM(sales_order_details.subTotal) FROM
            // (sales_orders RIGHT JOIN sales_order_details ON sales_orders.id = sales_order_details.sales_order_id)
            // RIGHT JOIN products ON sales_order_details.product_id = products.id
            // WHERE sales_orders.created_at BETWEEN '2020-06-15' AND '2020-07-31' GROUP BY  products.id, `date`
            // ORDER BY `date` ASC , products.id ASC

            $salesOrders = DB::table('sales_orders')
            ->select(
                DB::raw('products.id as p_id'), 'products.name',
                DB::raw('SUM(sales_order_details.subTotal) as subTotal'),
                DB::raw('SUM(sales_order_details.quantity) as quantity'),
                DB::raw('products.unit as unit'),
                DB::raw('DATE(sales_orders.created_at) as date'),
            )->rightJoin('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->rightJoin('products', 'products.id', '=', 'sales_order_details.product_id')
            ->whereBetween('sales_orders.created_at', [
                $start_date,
                $end_date
            ])->groupByRaw('sales_order_details.product_id, date')->orderBy('date', 'asc')->orderBy('p_id', 'asc')->get();

            foreach($salesOrders as $salesOrder){
                if($salesOrder->unit == "roll"){
                    $salesOrder->unit = "捲";
                }elseif($salesOrder->unit == "kg"){
                    $salesOrder->unit = "公斤";
                }else{
                    $salesOrder->unit = "包";
                }
            }

            $result = collect($salesOrders);
            $result = $result->groupBy('date');

            return [
                'status' => 200,
                'result' => $result,
            ];

        }
    }

    public function purchaseReportDaily($request){

        // 依原料別 SQL
        // SELECT materials.id,materials.name, DATE(purchase_orders.created_at) as `date`, SUM(purchase_order_details.subTotal) FROM
        // (purchase_orders RIGHT JOIN purchase_order_details ON purchase_orders.id = purchase_order_details.purchaseOrder_id)
        // RIGHT JOIN materials ON purchase_order_details.material_id = materials.id
        // WHERE purchase_orders.created_at BETWEEN '2020-06-15' AND '2020-07-31' GROUP BY  materials.id, `date`
        // ORDER BY `date` ASC , materials.id ASC

        // 依供應商別SQL
        // SELECT suppliers.id,suppliers.name, DATE(purchase_orders.created_at) as `date`, SUM(purchase_orders.totalPrice) FROM purchase_orders
        // RIGHT JOIN suppliers ON purchase_orders.supplier_id = suppliers.id
        // WHERE purchase_orders.created_at BETWEEN '2020-06-15' AND '2020-07-31' GROUP BY  suppliers.id, `date`
        // ORDER BY `date` ASC

        $type = $request->type;  // 1.'依供應商別', 2.'依原料別'
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $start_date.' 00:00')->toDateTimeString();
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $end_date.'23:59')->toDateTimeString();

        if($type == 1){
            // 依供應商
            $purchaseOrders = DB::table('purchase_orders')
            ->select(
                DB::raw('suppliers.id as s_id'), 'suppliers.name',
                DB::raw('SUM(purchase_orders.totalPrice) as subTotal'),
                DB::raw('DATE(purchase_orders.created_at) as date'))
            ->rightJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->whereBetween('purchase_orders.created_at', [
                $start_date,
                $end_date
            ])->groupByRaw('suppliers.id, date')->orderBy('date', 'asc')->get();

            $result = collect($purchaseOrders);
            $result = $result->groupBy('date');

            return [
                'status' => 200,
                'result' => $result,
            ];

        }else{
            // 依原料別
            $purchaseOrders = DB::table('purchase_orders')
            ->select(
                DB::raw('materials.id as m_id'), 'materials.name',
                DB::raw('SUM(purchase_order_details.subTotal) as subTotal'),
                DB::raw('SUM(purchase_order_details.quantity) as quantity'),
                DB::raw('materials.unit as unit'),
                DB::raw('DATE(purchase_orders.created_at) as date'),
            )->rightJoin('purchase_order_details', 'purchase_orders.id', '=', 'purchase_order_details.purchaseOrder_id')
            ->rightJoin('materials', 'materials.id', '=', 'purchase_order_details.material_id')
            ->whereBetween('purchase_orders.created_at', [
                $start_date,
                $end_date
            ])->groupByRaw('purchase_order_details.material_id, date')->orderBy('date', 'asc')->orderBy('m_id', 'asc')->get();

            $result = collect($purchaseOrders);
            $result = $result->groupBy('date');

            return [
                'status' => 200,
                'result' => $result,
            ];

        }
    }

    public function accountReportPayable(){
        // SELECT suppliers.*, SUM(purchase_orders.totalPrice) as totalPrice
        // FROM `purchase_orders` RIGHT JOIN suppliers ON suppliers.id = purchase_orders.supplier_id
        // WHERE purchase_orders.paid_at IS NULL GROUP BY suppliers.id

        $reports = DB::table('purchase_orders')
            ->select(
                DB::raw('suppliers.*'),
                DB::raw('SUM(purchase_orders.totalPrice) as totalPrice')
            )->rightJoin('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->where('purchase_orders.paid_at', '=', NULL)
            ->groupByRaw('suppliers.id')
            ->get();

            $reports = collect($reports);
            foreach($reports as $report){
                $report->showAddress = $report->companyAddress_county . $report->companyAddress_district . $report->companyAddress_others;
            }

            return $reports;
    }

    public function accountReportReceivable(){
        // SELECT consumers.*, SUM(sales_orders.unpaidAmount) as totalPrice
        // FROM `sales_orders` RIGHT JOIN consumers ON consumers.id = sales_orders.consumer_id
        // GROUP BY consumers.id

        $reports = DB::table('sales_orders')
            ->select(
                DB::raw('consumers.*'),
                DB::raw('SUM(sales_orders.unpaidAmount) as totalPrice')
            )->rightJoin('consumers', 'consumers.id', '=', 'sales_orders.consumer_id')
            ->groupByRaw('consumers.id')
            ->get();

            $reports = collect($reports);
            foreach($reports as $report){
                $report->showAddress = $report->address_county . $report->address_district . $report->address_others;
            }

            return $reports;
    }
}

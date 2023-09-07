<?php

namespace App\Http\Controllers\Orders;

use App\Consumer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PDF;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('billing.index');
    }

    public function generatePDF($consumer_id, $start_at, $end_at)
    {
//        $validator = Validator::make($request->all(), [
//            'consumer_id' => 'required|exists:consumers,id',
//            'start_at' => 'required|date|before_or_equal:end_at',
//            'end_at' => 'required|date|after_or_equal:start_at',
//        ]);
//
//        if ($validator->fails()) {
//            $data = [];
//            return view('billing.pdf', compact('data'));
//        }

//        $consumer_id = $request->input('consumer_id');
//        $start_at = $request->input('start_at');
//        $end_at = $request->input('end_at');

        $consumer = Consumer::with([
            'salesOrders' => function ($query) use ($start_at, $end_at) {
                $query->select('id', 'consumer_id', 'shown_id', 'transaction_at', 'taxType', 'paid_at')
                    ->whereNull('paid_at')
                    ->whereBetween('transaction_at', [ $start_at, $end_at ])
                    ->orderBy('transaction_at', 'asc');
            },
            'salesOrders.details' => function ($query) {
                $query->select('id', 'sales_order_id', 'product_id', 'count', 'price', 'quantity', 'discount', 'subTotal', 'comment');
            },
            'salesOrders.details.product' => function ($query) {
                $query->select('id', 'name', 'unit');
            }
        ])
        ->select('id', 'name', 'address_county', 'address_district', 'address_others', 'operator_name_1', 'operator_phone_1')
        ->where('id', $consumer_id)
        ->first();

        $periodTotalAmount = 0;    // 本期總金額
        $periodTaxAmount = 0;      // 本期總稅額
        $periodTotal = 0;          // 本期總額
        foreach ( $consumer->salesOrders as $salesOrder ) {
            $orderTotalAmount = 0;    // 訂單總金額
            $orderTaxAmount = 0;      // 訂單總稅額
            $orderTotal = 0;          // 訂單總額

            foreach ( $salesOrder->details as $detail ) {
                // 對於每個出貨單細項
                $totalAmount = 0;    // 金額（商品單價 x 數量 x 折數）
                $taxAmount = 0;      // 稅額（金額的 5%）
                $total = 0;          // 訂單總額（金額 + 稅額）

                $totalAmount = $detail->price * $detail->quantity * $detail->discount;
                $taxAmount = ( $salesOrder->taxType == 1 ) ? $totalAmount * 0.05 : 0 ;
                $total = $totalAmount + $taxAmount;

                $orderTotalAmount += $totalAmount;
                $orderTaxAmount += $taxAmount;
                $orderTotal += $total;

                $detail->totalAmount = $totalAmount;
                $detail->taxAmount = $taxAmount;
                $detail->total = $total;
            }

            $periodTotalAmount += $orderTotalAmount;
            $periodTaxAmount += $orderTaxAmount;
            $periodTotal += $orderTotal;

            $salesOrder->orderTotalAmount = $orderTotalAmount;
            $salesOrder->orderTaxAmount = $orderTaxAmount;
            $salesOrder->orderTotal = $orderTotal;
        }
        $consumer->periodTotalAmount = $periodTotalAmount;
        $consumer->periodTaxAmount = $periodTaxAmount;
        $consumer->periodTotal = $periodTotal;

        $data = collect([
            'consumer_id' => $consumer_id,
            'start_at' => str_replace("-", "/", $start_at),
            'end_at' => str_replace("-", "/", $end_at),
            'result' => $consumer,
        ]);

        return view('billing.pdf', compact('data'));

        // instantiate and use the dompdf class
//        $pdf = PDF::LoadView('billing.pdf', compact('data'));
//
//        // (Optional) Setup the paper size and orientation
//        $pdf->setPaper('A4', 'landscape');
//
//        return $pdf->stream('尚達塑膠有限公司_客戶_請款單.pdf');
    }
}

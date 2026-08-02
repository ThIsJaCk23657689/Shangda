<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public $ReportService;

    public function __construct()
    {
        $this->middleware(['auth', 'job.title:4,3']);
        $this->ReportService = new ReportService();
    }

    // 銷售 年度報表
    public function salesReportYearIndex(){
        return redirect()->route('reports.sales.analysis', [
            'tab' => 'overview',
            'dimension' => request('type') == 2 ? 'product' : 'customer',
        ]);
    }

    public function salesReportYear(Request $request){
        $this->validate($request, [
            'type' => [
                'nullable',
                Rule::in([1, 2]), // 1.'依客戶別', 2.'依商品別'
            ],
            'year'=> 'nullable|digits:4',
            'orderby' => [
                'nullable',
                Rule::in([1, 2]), // 1.'升序', 2.'降序'
            ],
        ]);
        $res = $this->ReportService->salesReportYear($request);
        return response()->json($res, $res['status']);
    }

    public function salesReportMonthIndex(){
        return redirect()->route('reports.sales.analysis', [
            'tab' => 'drilldown',
            'dimension' => 'product',
            'mode' => 'annual',
        ]);
    }

    public function salesReportMonth(Request $request){
        $this->validate($request, [
            'year' => 'nullable|digits:4',
            'month' => 'nullable|digits_between:1,2',
        ]);
        $res = $this->ReportService->salesReportMonth($request);
        return response()->json($res, $res['status']);
    }

    public function salesMonthTrend(Request $request) {
        $this->validate($request, [
            'product_id' => 'integer',
            'year' => 'nullable|digits:4',
            'month' => 'nullable|digits_between:1,2',
        ]);
        $res = $this->ReportService->salesMonthTrend($request, 3);
        return response()->json($res, $res['status']);
    }

    // 銷售 日度報表
    public function salesReportDailyIndex(){
        return redirect()->route('reports.sales.analysis', [
            'tab' => 'detail',
            'dimension' => request('type') == 2 ? 'product' : 'customer',
        ]);
    }

    public function salesReportDaily(Request $request){
        $this->validate($request, [
            'type' => [
                'nullable',
                Rule::in([1, 2]), // 1.'依客戶別', 2.'依商品別'
            ],
            'start_date'=> 'nullable|date_format:Y-m-d',
            'end_date'=> 'nullable|date_format:Y-m-d',
        ]);
        $res = $this->ReportService->salesReportDaily($request);
        return response()->json($res, $res['status']);
    }

    // 指定顧客銷售明細報表
    public function customerSalesDetailIndex()
    {
        return redirect()->route('reports.sales.analysis', [
            'tab' => 'detail',
            'dimension' => 'customer',
        ]);
    }

    public function customerSalesDetail(Request $request)
    {
        $this->validateCustomerSalesDetail($request);

        return response()->json($this->ReportService->customerSalesDetail($request));
    }

    public function exportCustomerSalesDetail(Request $request)
    {
        $this->validateCustomerSalesDetail($request, false);

        $consumer = $this->ReportService->findCustomerSalesConsumer($request->consumer_id);
        $safeConsumerName = preg_replace('/[\\\\\/:*?"<>|]+/u', '_', $consumer->name);
        $filename = sprintf(
            '顧客銷售明細_%s_%s_%s.csv',
            $safeConsumerName,
            str_replace('-', '', $request->start_date),
            str_replace('-', '', $request->end_date)
        );

        return response()->streamDownload(function () use ($request) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, [
                '顧客名稱', '統一編號', '日期依據', '日期', '單別', '訂單編號',
                '付款狀態', '出貨狀態', '商品編號', '商品名稱', '單位', '數量',
                '單價', '折數', '品項小計', '訂單未稅額', '訂單稅額', '訂單含稅總額',
                '訂單備註', '品項備註',
            ]);

            $this->ReportService->exportCustomerSalesDetails($request, function ($order, $detail, $isFirst) use ($output) {
                $sign = $order->status == 2 ? -1 : 1;
                $row = [
                    $order->consumer_name,
                    $order->consumer_tax_id,
                    $order->date_type_label,
                    $order->date_value,
                    $order->order_type,
                    $order->shown_id,
                    $order->payment_status,
                    $order->delivery_status,
                    $detail ? $detail->product_shown_id : '',
                    $detail ? $detail->product_name : '',
                    $detail ? $detail->unit_label : '',
                    $detail ? $detail->signed_quantity : '',
                    $detail ? $detail->price : '',
                    $detail ? $detail->discount : '',
                    $detail ? $detail->signed_subtotal : '',
                    $isFirst ? $sign * (float) $order->totalPrice : '',
                    $isFirst ? $sign * (float) $order->taxPrice : '',
                    $isFirst ? $sign * (float) $order->totalTaxPrice : '',
                    $order->comment,
                    $detail ? $detail->comment : '',
                ];

                fputcsv($output, array_map([$this, 'escapeCsvValue'], $row));
            });

            fclose($output);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function escapeCsvValue($value)
    {
        if (is_string($value) && preg_match('/^[=+\-@]/u', $value)) {
            return "'" . $value;
        }

        return $value;
    }

    private function validateCustomerSalesDetail(Request $request, $withPagination = true)
    {
        $rules = [
            'consumer_id' => 'required|integer|exists:consumers,id',
            'date_type' => ['required', Rule::in(['transaction', 'delivered', 'paid', 'created'])],
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'include_returns' => 'required|boolean',
            'order_status' => ['required', Rule::in(['all', 'unpaid', 'paid', 'undelivered', 'completed'])],
        ];

        if ($withPagination) {
            $rules['page'] = 'nullable|integer|min:1';
            $rules['per_page'] = ['nullable', Rule::in([10, 20, 50])];
        }

        $this->validate($request, $rules);
    }

    // 銷售利潤報表
    public function salesReportProfitIndex(){
        return view('reports.sales.profit');
    }

    public function salesReportProfit(Request $request){

    }

    // 進貨 年度報表
    public function purchaseReportYearIndex(){
        return view('reports.purchase.year');
    }

    public function purchaseReportYear(Request $request){
        $this->validate($request, [
            'type' => [
                'nullable',
                Rule::in([1, 2]), // 1.'依供應商別', 2.'依原物料別'
            ],
            'year'=> 'nullable|digits:4',
            'orderby' => [
                'nullable',
                Rule::in([1, 2]), // 1.'升序', 2.'降序'
            ],
        ]);
        $res = $this->ReportService->purchaseReportYear($request);
        return response()->json($res, $res['status']);
    }

    // 進貨 日度報表
    public function purchaseReportDailyIndex(){
        return view('reports.purchase.daily');
    }

    public function purchaseReportDaily(Request $request){
        $this->validate($request, [
            'type' => [
                'nullable',
                Rule::in([1, 2]), // 1.'依供應商別', 2.'依原物料別'
            ],
            'start_date'=> 'nullable|date_format:Y-m-d',
            'end_date'=> 'nullable|date_format:Y-m-d',
        ]);
        $res = $this->ReportService->purchaseReportDaily($request);
        return response()->json($res, $res['status']);
    }

    public function accountReportPayable(){
        $reports = $this->ReportService->accountReportPayable();
        return view('reports.account.payable', compact('reports'));
    }

    // 應付帳款 日度報表
    public function accountReportPayableDailyIndex(){
        return view('reports.account.payable_daily');
    }

    public function accountReportPayableDaily(Request $request){
        $this->validate($request, [
            'start_date'=> 'nullable|date_format:Y-m-d',
            'end_date'=> 'nullable|date_format:Y-m-d',
        ]);
        $res = $this->ReportService->accountReportPayableDaily($request);
        return response()->json($res, $res['status']);
    }

    public function accountReportReceivable(){
        $reports = $this->ReportService->accountReportReceivable();
        return view('reports.account.receivable', compact('reports'));
    }

    // 應收帳款 日度報表
    public function accountReportReceivableDailyIndex(){
        return view('reports.account.receivable_daily');
    }

    public function accountReportReceivableDaily(Request $request){
        $this->validate($request, [
            'start_date'=> 'nullable|date_format:Y-m-d',
            'end_date'=> 'nullable|date_format:Y-m-d',
        ]);
        $res = $this->ReportService->accountReportReceivableDaily($request);
        return response()->json($res, $res['status']);
    }
}

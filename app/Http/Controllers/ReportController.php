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
        $this->middleware('auth');
        $this->ReportService = new ReportService();
    }

    // 銷售 年度報表
    public function salesReportYearIndex(){
        return view('reports.sales.year');
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

    // 銷售 日度報表
    public function salesReportDailyIndex(){
        return view('reports.sales.daily');
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

    public function accountReportReceivable(){
        $reports = $this->ReportService->accountReportReceivable();
        return view('reports.account.receivable', compact('reports'));
    }
}

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
            'year'=> 'nullable|digits:4'
        ]);
        $res = $this->ReportService->salesReportYear($request);
        return response()->json($res, $res['status']);

    }

    // 銷售 日度報表
    public function salesReportDailyIndex(){
        return view('');
    }

    public function salesReportDaily(Request $request){

    }

    // 銷售利潤報表
    public function salesReportProfitIndex(){
        return view('');
    }
    public function salesReportProfit(Request $request){

    }


}

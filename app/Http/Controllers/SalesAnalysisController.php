<?php

namespace App\Http\Controllers;

use App\Services\SalesAnalysisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;

class SalesAnalysisController extends Controller
{
    private $service;

    public function __construct(SalesAnalysisService $service)
    {
        $this->middleware(['auth', 'job.title:4,3']);
        $this->service = $service;
    }

    public function index()
    {
        return view('reports.sales.analysis', [
            'urls' => [
                'meta' => route('reports.sales.analysis.meta'),
                'entities' => route('reports.sales.analysis.entities'),
                'overview' => route('reports.sales.analysis.overview'),
                'drilldown' => route('reports.sales.analysis.drilldown'),
                'details' => route('reports.sales.analysis.details'),
                'csv' => route('reports.sales.analysis.export.csv'),
                'pdf' => route('reports.sales.analysis.export.pdf'),
            ],
        ]);
    }

    public function meta()
    {
        return response()->json($this->service->meta());
    }

    public function entities(Request $request)
    {
        $this->validate($request, [
            'dimension' => ['required', Rule::in(['customer', 'product'])],
            'query' => 'nullable|string|max:100',
            'id' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
            'per_page' => ['nullable', Rule::in([20])],
        ]);

        return response()->json($this->service->entities($request));
    }

    public function overview(Request $request)
    {
        $this->validateOverview($request);
        return response()->json($this->service->overview($request));
    }

    public function drilldown(Request $request)
    {
        $this->validateDrilldown($request);
        $this->service->findEntity($request->dimension, $request->entity_id);
        return response()->json($this->service->drilldown($request));
    }

    public function details(Request $request)
    {
        $this->validateDetails($request);
        if ($request->filled('entity_id')) {
            $this->service->findEntity($request->dimension, $request->entity_id);
        }
        return response()->json($this->service->details($request));
    }

    public function exportCsv(Request $request)
    {
        $this->validateExport($request);
        $table = $request->tab === 'detail' ? null : $this->service->exportTable($request);
        $filename = $this->exportFilename($request, 'csv');

        return response()->streamDownload(function () use ($request, $table) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");

            if ($request->tab === 'detail') {
                $headers = ['銷貨單號', '日期', '單別', '顧客', '商品編號', '商品', '單位', '數量', '單價', '折數', '金額'];
                fputcsv($output, $headers);
                $this->service->streamDetailRows($request, function ($row) use ($output) {
                    fputcsv($output, $this->escapeCsvRow([
                        $row['shown_id'], $row['transaction_date'], $row['order_type'],
                        $row['customer_name'], $row['product_code'], $row['product_name'],
                        $row['unit'], $row['quantity'], $row['price'], $row['discount'], $row['amount'],
                    ]));
                });
            } else {
                fputcsv($output, $table['headers']);
                foreach ($table['rows'] as $row) {
                    fputcsv($output, $this->escapeCsvRow($row));
                }
            }

            fclose($output);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function exportPdf(Request $request)
    {
        $this->validateExport($request, true);
        $table = $this->service->exportTable($request, $request->tab === 'detail' ? 5001 : null);
        if ($request->tab === 'detail' && count($table['rows']) > 5000) {
            return response()->json([
                'message' => 'PDF 明細超過 5,000 列，請縮小日期範圍或指定實體；CSV 仍可匯出全部資料。',
            ], 422);
        }

        $chartImage = null;
        if ($request->filled('chart_image') && preg_match('/^data:image\/png;base64,[A-Za-z0-9+\/=]+$/', $request->chart_image)) {
            $chartImage = $request->chart_image;
        }

        $pdf = PDF::loadView('reports.sales.analysis_pdf', [
            'tab' => $request->tab,
            'title' => $table['title'],
            'headers' => $table['headers'],
            'rows' => $table['rows'],
            'sections' => $table['sections'] ?? [],
            'summary' => $table['summary'] ?? null,
            'chartImage' => $chartImage,
            'filters' => $request->all(),
            'filterSummary' => $this->filterSummary($request),
            'periodLabel' => $table['period_label'],
            'generatedAt' => now(),
        ]);
        try {
            $this->registerTraditionalChineseFonts($pdf);
        } catch (\RuntimeException $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
        $pdf->setPaper('a4', 'portrait');

        $filename = $this->exportFilename($request, 'pdf');
        $response = $pdf->download($filename);
        $response->headers->set('X-Export-Filename', rawurlencode($filename));
        return $response;
    }

    private function validateOverview(Request $request)
    {
        $request->merge(['period_mode' => $request->input('period_mode', 'year')]);
        $this->validate($request, array_merge($this->commonRules(), [
            'year' => 'required|digits:4',
            'period_mode' => ['required', Rule::in(['year', 'month', 'range'])],
            'month' => 'nullable|required_if:period_mode,month|integer|between:1,12',
            'start_month' => 'nullable|required_if:period_mode,range|integer|between:1,12',
            'end_month' => 'nullable|required_if:period_mode,range|integer|between:1,12|gte:start_month',
            'sort' => ['required', Rule::in(['asc', 'desc'])],
            'exclude_zero' => 'required|boolean',
        ]));
        $months = $request->period_mode === 'month'
            ? [(int) $request->month]
            : ($request->period_mode === 'range' ? [(int) $request->start_month, (int) $request->end_month] : []);
        $this->validateNotFutureMonths((int) $request->year, $months);
    }

    private function validateDrilldown(Request $request)
    {
        $rules = array_merge($this->commonRules(), [
            'entity_id' => 'required|integer|min:1',
            'mode' => ['required', Rule::in(['annual', 'trend', 'comparison'])],
        ]);
        if ($request->mode === 'trend') {
            $rules['recent_years'] = ['required', Rule::in(['3', '5', '10', 'all', 3, 5, 10])];
        } elseif ($request->mode === 'comparison') {
            $rules['year_a'] = 'required|digits:4|different:year_b';
            $rules['year_b'] = 'required|digits:4';
            $rules['start_month'] = 'required|integer|between:1,12';
            $rules['end_month'] = 'required|integer|between:1,12|gte:start_month';
        } else {
            $rules['year'] = 'required|digits:4';
            $rules['start_month'] = 'nullable|integer|between:1,12';
            $rules['end_month'] = 'nullable|integer|between:1,12|gte:start_month';
        }
        $this->validate($request, $rules);
        if ($request->mode === 'annual') {
            $this->validateNotFutureMonths((int) $request->year, array_filter([
                $request->filled('start_month') ? (int) $request->start_month : null,
                $request->filled('end_month') ? (int) $request->end_month : null,
            ]));
        } elseif ($request->mode === 'comparison') {
            $this->validateNotFutureMonths((int) $request->year_a, [(int) $request->end_month]);
            $this->validateNotFutureMonths((int) $request->year_b, [(int) $request->end_month]);
        }
    }

    private function validateDetails(Request $request)
    {
        $this->validate($request, array_merge($this->commonRules(), [
            'entity_id' => 'nullable|integer|min:1',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'date_basis' => ['required', Rule::in(['transaction', 'delivered', 'paid', 'created'])],
            'order_status' => ['required', Rule::in(['all', 'unpaid', 'paid', 'undelivered', 'completed'])],
            'sort_by' => ['required', Rule::in(['transaction_date', 'shown_id', 'customer_name', 'product_name', 'quantity', 'amount'])],
            'sort_direction' => ['required', Rule::in(['asc', 'desc'])],
            'page' => 'nullable|integer|min:1',
            'per_page' => ['nullable', Rule::in([20, 50, 100])],
        ]));
    }

    private function validateExport(Request $request, $pdf = false)
    {
        $this->validate($request, [
            'tab' => ['required', Rule::in(['overview', 'drilldown', 'detail'])],
            'chart_image' => $pdf ? 'nullable|string|max:4000000' : 'nullable',
        ]);

        if ($request->tab === 'overview') {
            $this->validateOverview($request);
        } elseif ($request->tab === 'drilldown') {
            $this->validateDrilldown($request);
            $this->service->findEntity($request->dimension, $request->entity_id);
        } else {
            $this->validateDetails($request);
            if ($request->filled('entity_id')) {
                $this->service->findEntity($request->dimension, $request->entity_id);
            }
        }
    }

    private function commonRules()
    {
        return [
            'dimension' => ['required', Rule::in(['customer', 'product'])],
            'amount_basis' => ['required', Rule::in(['pre_tax', 'tax_inclusive'])],
        ];
    }

    private function escapeCsvRow(array $row)
    {
        return array_map(function ($value) {
            if (is_string($value) && preg_match('/^[\x00-\x20]*[=+\-@]/u', $value)) {
                return "'" . $value;
            }
            return $value;
        }, $row);
    }

    private function validateNotFutureMonths($year, array $months)
    {
        $today = Carbon::now('Asia/Taipei');
        if ($year > $today->year || ($year === $today->year && !empty($months) && max($months) > $today->month)) {
            throw ValidationException::withMessages([
                'end_month' => ['不可選擇尚未到來的月份。'],
            ]);
        }
    }

    private function exportFilename(Request $request, $extension)
    {
        return '銷售分析_' . $request->tab . '_' . $this->service->exportFilenameToken($request) . '_' . now()->format('Ymd_His') . '.' . $extension;
    }

    private function filterSummary(Request $request)
    {
        $summary = [
            '分析維度：' . ($request->dimension === 'product' ? '商品' : '顧客'),
            '金額口徑：' . ($request->amount_basis === 'tax_inclusive' ? '含稅淨銷售額' : '未稅淨銷售額'),
        ];
        if ($request->tab === 'detail') {
            $dateLabels = ['transaction' => '交易日期', 'delivered' => '出貨日期', 'paid' => '付款日期', 'created' => '建立日期'];
            $statusLabels = ['all' => '全部', 'unpaid' => '未付款', 'paid' => '已付款', 'undelivered' => '未出貨', 'completed' => '已完成'];
            $summary[] = '日期依據：' . ($dateLabels[$request->date_basis] ?? '交易日期');
            $summary[] = '狀態：' . ($statusLabels[$request->order_status] ?? '全部');
        }
        return $summary;
    }

    private function registerTraditionalChineseFonts($pdf)
    {
        $fonts = config('dompdf.sales_analysis_fonts', []);
        $styles = [
            'normal' => ['weight' => 'normal', 'style' => 'normal'],
            'bold' => ['weight' => 'bold', 'style' => 'normal'],
        ];

        foreach ($styles as $key => $style) {
            $fontPath = $fonts[$key] ?? null;
            if (!$fontPath || !is_file($fontPath)) {
                throw new \RuntimeException('PDF 繁中字型檔遺失，請聯絡系統管理員重新部署 Noto Sans TC 字型。');
            }

            $fontUri = 'file://' . str_replace('\\', '/', $fontPath);
            $registered = $pdf->getDomPDF()->getFontMetrics()->registerFont([
                'family' => 'Noto Sans TC',
                'weight' => $style['weight'],
                'style' => $style['style'],
            ], $fontUri);

            if (!$registered) {
                throw new \RuntimeException('PDF 繁中字型註冊失敗，請聯絡系統管理員檢查 storage/fonts 權限。');
            }
        }
    }
}

<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService extends BaseService
{
    private $salesAnalysisService;

    public function __construct(SalesAnalysisService $salesAnalysisService)
    {
        $this->salesAnalysisService = $salesAnalysisService;
    }

    public function data(Carbon $now = null)
    {
        $now = ($now ?: Carbon::now('Asia/Taipei'))->copy()->timezone('Asia/Taipei');
        $today = $now->toDateString();
        $overdueDays = max(0, (int) config('shangda.dashboard.overdue_days', 30));

        $sales = $this->salesAnalysisService->dashboardSalesSummary($now);
        $receivables = $this->receivableSummary();
        $overdue = $this->overdueSummary($today, $overdueDays);
        $materials = $this->materialSummary();

        return [
            'generated_at' => $now->format('Y-m-d H:i'),
            'year' => $now->year,
            'sales' => $sales,
            'receivables' => $receivables,
            'overdue' => $overdue,
            'materials' => $materials,
            'settings' => [
                'overdue_days' => $overdueDays,
            ],
        ];
    }

    private function receivableBaseQuery()
    {
        return DB::table('sales_orders as so')
            ->where('so.confirmStatus', 1)
            ->where('so.status', 1)
            ->where('so.unpaidAmount', '>', 0);
    }

    private function receivableSummary()
    {
        $row = $this->receivableBaseQuery()
            ->selectRaw('COALESCE(SUM(so.unpaidAmount), 0) as balance, COUNT(DISTINCT so.consumer_id) as customer_count')
            ->first();

        return [
            'balance' => (float) $row->balance,
            'customer_count' => (int) $row->customer_count,
        ];
    }

    private function overdueBaseQuery($today, $overdueDays)
    {
        // Equivalent to DATEDIFF(today, expectPay_at) > threshold, while keeping
        // expectPay_at bare so MySQL can use the dashboard receivable index.
        $cutoff = Carbon::parse($today, 'Asia/Taipei')
            ->subDays($overdueDays)
            ->startOfDay()
            ->format('Y-m-d H:i:s');

        return $this->receivableBaseQuery()
            ->whereNotNull('so.expectPay_at')
            ->where('so.expectPay_at', '<', $cutoff);
    }

    private function overdueSummary($today, $overdueDays)
    {
        $summary = $this->overdueBaseQuery($today, $overdueDays)
            ->selectRaw('COALESCE(SUM(so.unpaidAmount), 0) as balance, COUNT(DISTINCT so.consumer_id) as customer_count')
            ->first();

        $items = $this->overdueBaseQuery($today, $overdueDays)
            ->leftJoin('consumers as c', 'c.id', '=', 'so.consumer_id')
            ->select(
                'so.consumer_id',
                DB::raw("COALESCE(c.name, CONCAT('顧客資料已移除 #', so.consumer_id)) as customer_name")
            )
            ->selectRaw('SUM(so.unpaidAmount) as amount')
            ->selectRaw('MAX(DATEDIFF(?, so.expectPay_at)) as overdue_days', [$today])
            ->groupBy('so.consumer_id', 'c.name')
            ->orderByDesc('overdue_days')
            ->orderByDesc('amount')
            ->limit(5)
            ->get()
            ->map(function ($row) {
                return [
                    'consumer_id' => (int) $row->consumer_id,
                    'customer_name' => $row->customer_name,
                    'amount' => (float) $row->amount,
                    'overdue_days' => (int) $row->overdue_days,
                ];
            })
            ->all();

        $customerCount = (int) $summary->customer_count;

        return [
            'balance' => (float) $summary->balance,
            'customer_count' => $customerCount,
            'items' => $items,
            'remaining_count' => max(0, $customerCount - count($items)),
        ];
    }

    private function materialBaseQuery()
    {
        return DB::table('materials')
            ->whereNotNull('safeQuantity')
            ->where('safeQuantity', '>', 0);
    }

    private function materialSummary()
    {
        $lowStockCount = $this->materialBaseQuery()
            ->whereColumn('stock', '<', 'safeQuantity')
            ->count();

        $lowStockItems = $this->materialBaseQuery()
            ->whereColumn('stock', '<', 'safeQuantity')
            ->select('id', 'name', 'unit', 'stock', 'safeQuantity')
            ->selectRaw('stock / NULLIF(safeQuantity, 0) as stock_ratio')
            ->orderBy('stock_ratio')
            ->orderBy('name')
            ->limit(5)
            ->get()
            ->map(function ($row) {
                return $this->formatMaterial($row);
            })
            ->all();

        $levels = $this->materialBaseQuery()
            ->select('id', 'name', 'unit', 'stock', 'safeQuantity')
            ->selectRaw('stock / NULLIF(safeQuantity, 0) as stock_ratio')
            ->orderBy('stock_ratio')
            ->orderBy('name')
            ->get()
            ->map(function ($row) {
                return $this->formatMaterial($row);
            })
            ->all();

        return [
            'low_stock_count' => (int) $lowStockCount,
            'low_stock_items' => $lowStockItems,
            'remaining_low_stock_count' => max(0, (int) $lowStockCount - count($lowStockItems)),
            'levels' => $levels,
        ];
    }

    private function formatMaterial($row)
    {
        $divisor = (int) $row->unit === 2 ? 1000 : 1;

        return [
            'id' => (int) $row->id,
            'name' => $row->name,
            'stock' => (float) $row->stock / $divisor,
            'safe_quantity' => (float) $row->safeQuantity / $divisor,
            'unit' => (int) $row->unit === 2 ? '公噸' : '公斤',
            'ratio' => (float) $row->stock_ratio,
            'is_low' => (float) $row->stock < (float) $row->safeQuantity,
        ];
    }
}

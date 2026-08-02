<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesAnalysisService extends BaseService
{
    const DIMENSION_CUSTOMER = 'customer';
    const DIMENSION_PRODUCT = 'product';
    const BASIS_PRE_TAX = 'pre_tax';
    const BASIS_TAX_INCLUSIVE = 'tax_inclusive';

    /**
     * Return the sales aggregates used by the management dashboard.
     *
     * This intentionally shares the same order filters, transaction-date
     * fallback and signed amount expression as the sales analysis report.
     */
    public function dashboardSalesSummary(Carbon $now = null)
    {
        $now = ($now ?: Carbon::now('Asia/Taipei'))->copy()->timezone('Asia/Taipei');
        $currentStart = $now->copy()->startOfMonth();
        $currentEnd = $now->copy()->endOfMonth();
        $trendStart = $now->copy()->subMonths(11)->startOfMonth();
        $previousStart = $now->copy()->subYear()->startOfMonth();
        $previousEnd = $now->copy()->subYear()->endOfMonth();

        $date = $this->transactionDateExpression('so');
        $amount = $this->amountExpression(self::BASIS_PRE_TAX);
        $period = 'DATE_FORMAT(' . $date . ", '%Y-%m')";

        $base = $this->lineQuery(self::BASIS_PRE_TAX);
        $this->applyCoreFilters($base);

        $trendValues = (clone $base)
            ->whereBetween(DB::raw($date), [
                $trendStart->format('Y-m-d H:i:s'),
                $currentEnd->format('Y-m-d H:i:s'),
            ])
            ->selectRaw($period . ' as period, COALESCE(SUM(' . $amount . '), 0) as amount')
            ->groupByRaw($period)
            ->pluck('amount', 'period');

        $trend = [];
        for ($month = $trendStart->copy(); $month->lte($currentStart); $month->addMonth()) {
            $key = $month->format('Y-m');
            $trend[] = [
                'period' => $key,
                'label' => $month->format('Y/m'),
                'amount' => (float) ($trendValues[$key] ?? 0),
            ];
        }

        $previousYearAmount = (float) (clone $base)
            ->whereBetween(DB::raw($date), [
                $previousStart->format('Y-m-d H:i:s'),
                $previousEnd->format('Y-m-d H:i:s'),
            ])
            ->selectRaw('COALESCE(SUM(' . $amount . '), 0) as amount')
            ->value('amount');

        $currentAmount = count($trend) ? (float) $trend[count($trend) - 1]['amount'] : 0.0;
        $yearOverYear = abs($previousYearAmount) > 0.0001
            ? (($currentAmount - $previousYearAmount) / abs($previousYearAmount)) * 100
            : null;

        $topCustomers = (clone $base)
            ->whereBetween(DB::raw($date), [
                $currentStart->format('Y-m-d H:i:s'),
                $currentEnd->format('Y-m-d H:i:s'),
            ])
            ->select(
                'so.consumer_id',
                DB::raw("COALESCE(c.name, CONCAT('顧客資料已移除 #', so.consumer_id)) as customer_name")
            )
            ->selectRaw('SUM(' . $amount . ') as amount')
            ->groupBy('so.consumer_id', 'c.name')
            ->havingRaw('SUM(' . $amount . ') > 0')
            ->orderByDesc('amount')
            ->limit(5)
            ->get()
            ->map(function ($row) {
                return [
                    'id' => (int) $row->consumer_id,
                    'name' => $row->customer_name,
                    'amount' => (float) $row->amount,
                ];
            })
            ->all();

        return [
            'current_month' => $currentAmount,
            'previous_year_month' => $previousYearAmount,
            'year_over_year' => $yearOverYear,
            'trend' => $trend,
            'top_customers' => $topCustomers,
        ];
    }

    public function meta()
    {
        $dateExpression = $this->transactionDateExpression('sales_orders');
        $years = DB::table('sales_orders')
            ->where('confirmStatus', 1)
            ->whereIn('status', [1, 2])
            ->selectRaw('YEAR(' . $dateExpression . ') as year')
            ->groupByRaw('YEAR(' . $dateExpression . ')')
            ->orderBy('year')
            ->pluck('year')
            ->map(function ($year) {
                return (int) $year;
            })
            ->values()
            ->all();

        $currentYear = Carbon::now()->year;
        if (!in_array($currentYear, $years, true)) {
            $years[] = $currentYear;
            sort($years);
        }

        return [
            'years' => $years,
            'defaults' => [
                'year' => $currentYear,
                'dimension' => self::DIMENSION_CUSTOMER,
                'amount_basis' => self::BASIS_PRE_TAX,
            ],
        ];
    }

    public function entities(Request $request)
    {
        $dimension = $request->dimension;
        $perPage = (int) ($request->per_page ?: 20);
        $page = (int) ($request->page ?: 1);
        $queryText = trim((string) $request->input('query', ''));

        if ($dimension === self::DIMENSION_CUSTOMER) {
            $query = DB::table('consumers')
                ->select('id', 'name', 'shortName as secondary', 'taxID as code', 'deleted_at');
            if ($queryText !== '') {
                $query->where(function ($builder) use ($queryText) {
                    $keyword = '%' . $queryText . '%';
                    $builder->where('name', 'like', $keyword)
                        ->orWhere('shortName', 'like', $keyword)
                        ->orWhere('taxID', 'like', $keyword);
                });
            }
        } else {
            $query = DB::table('products')
                ->select('id', 'name', 'specification as secondary', 'shownID as code', 'deleted_at');
            if ($queryText !== '') {
                $query->where(function ($builder) use ($queryText) {
                    $keyword = '%' . $queryText . '%';
                    $builder->where('name', 'like', $keyword)
                        ->orWhere('shownID', 'like', $keyword)
                        ->orWhere('specification', 'like', $keyword);
                });
            }
        }

        if ($request->filled('id')) {
            $query->where('id', (int) $request->id);
        }

        $result = $query
            ->orderByRaw('deleted_at IS NULL desc')
            ->orderBy('name')
            ->paginate($perPage, ['*'], 'page', $page);

        if ($request->filled('id') && $result->isEmpty()) {
            $entity = $this->findEntity($dimension, (int) $request->id);
            return [
                'data' => [[
                    'id' => $entity['id'],
                    'name' => $entity['name'],
                    'secondary' => null,
                    'code' => null,
                    'is_deleted' => true,
                ]],
                'pagination' => ['current_page' => 1, 'last_page' => 1, 'total' => 1],
            ];
        }

        return [
            'data' => collect($result->items())->map(function ($entity) {
                return [
                    'id' => (int) $entity->id,
                    'name' => $entity->name,
                    'secondary' => $entity->secondary,
                    'code' => $entity->code,
                    'is_deleted' => !is_null($entity->deleted_at),
                ];
            })->all(),
            'pagination' => [
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'total' => $result->total(),
            ],
        ];
    }

    public function overview(Request $request)
    {
        $year = (int) $request->year;
        $dimension = $request->dimension;
        $amount = $this->amountExpression($request->amount_basis, 'so', 'sod', true);
        $date = $this->transactionDateExpression('so');
        $start = sprintf('%d-01-01 00:00:00', $year);
        $end = sprintf('%d-12-31 23:59:59', $year);

        if ($dimension === self::DIMENSION_CUSTOMER) {
            $query = DB::table('consumers as entity')
                ->leftJoin('sales_orders as so', function ($join) use ($date, $start, $end) {
                    $join->on('so.consumer_id', '=', 'entity.id')
                        ->where('so.confirmStatus', '=', 1)
                        ->whereIn('so.status', [1, 2])
                        ->whereBetween(DB::raw($date), [$start, $end]);
                })
                ->leftJoin('sales_order_details as sod', 'sod.sales_order_id', '=', 'so.id');
        } else {
            $query = DB::table('products as entity')
                ->leftJoin('sales_order_details as sod', 'sod.product_id', '=', 'entity.id')
                ->leftJoin('sales_orders as so', function ($join) use ($date, $start, $end) {
                    $join->on('so.id', '=', 'sod.sales_order_id')
                        ->where('so.confirmStatus', '=', 1)
                        ->whereIn('so.status', [1, 2])
                        ->whereBetween(DB::raw($date), [$start, $end]);
                });
        }

        $select = ['entity.id', 'entity.name', 'entity.deleted_at'];
        for ($month = 1; $month <= 12; $month++) {
            $select[] = DB::raw('COALESCE(SUM(CASE WHEN MONTH(' . $date . ') = ' . $month . ' THEN ' . $amount . ' ELSE 0 END), 0) as month_' . $month);
        }
        $select[] = DB::raw('COALESCE(SUM(' . $amount . '), 0) as annual_total');

        $query->select($select)->groupBy('entity.id', 'entity.name', 'entity.deleted_at');
        if ($request->boolean('exclude_zero')) {
            $query->havingRaw('ABS(annual_total) > 0.0001');
        }
        $query->orderBy('annual_total', $request->sort === 'asc' ? 'asc' : 'desc');

        $rows = $query->get()->map(function ($row) {
            $months = [];
            for ($month = 1; $month <= 12; $month++) {
                $property = 'month_' . $month;
                $months[] = (float) $row->{$property};
            }
            return [
                'entity' => [
                    'id' => (int) $row->id,
                    'name' => $row->name,
                    'is_deleted' => !is_null($row->deleted_at),
                ],
                'months' => $months,
                'total' => (float) $row->annual_total,
            ];
        })->values();

        // 歷史明細可能仍保留已被實體刪除的外鍵；以清楚的替代名稱保留其金額，
        // 避免 Overview 與 Drill-down／Detail 的總額不一致。
        $rows = $rows->concat($this->orphanOverviewRows(
            $dimension,
            $request->amount_basis,
            $start,
            $end,
            $request->boolean('exclude_zero')
        ))->sortBy('total', SORT_REGULAR, $request->sort !== 'asc')->values();

        $monthTotals = array_fill(0, 12, 0.0);
        foreach ($rows as $row) {
            foreach ($row['months'] as $index => $value) {
                $monthTotals[$index] += $value;
            }
        }

        return [
            'year' => $year,
            'display_months' => $this->displayMonthsForYear($year),
            'rows' => $rows->all(),
            'chart' => $rows->take(10)->map(function ($row) {
                return [
                    'id' => $row['entity']['id'],
                    'label' => $row['entity']['name'],
                    'value' => $row['total'],
                ];
            })->all(),
            'totals' => [
                'months' => $monthTotals,
                'total' => array_sum($monthTotals),
            ],
        ];
    }

    public function drilldown(Request $request)
    {
        if ($request->mode === 'trend') {
            return $this->trend($request);
        }
        if ($request->mode === 'comparison') {
            return $this->comparison($request);
        }
        return $this->annualDrilldown($request);
    }

    private function annualDrilldown(Request $request)
    {
        $year = (int) $request->year;
        $query = $this->lineQuery($request->amount_basis);
        $this->applyCoreFilters($query);
        $this->applyEntityFilter($query, $request->dimension, $request->entity_id);
        $date = $this->transactionDateExpression('so');
        $query->whereBetween(DB::raw($date), [
            $year . '-01-01 00:00:00',
            $year . '-12-31 23:59:59',
        ]);
        $amount = $this->amountExpression($request->amount_basis);

        $aggregates = $query->selectRaw('MONTH(' . $date . ') as month, SUM(' . $amount . ') as amount')
            ->groupByRaw('MONTH(' . $date . ')')
            ->pluck('amount', 'month');

        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[] = (float) ($aggregates[$month] ?? 0);
        }
        $total = array_sum($months);

        $overall = $this->lineQuery($request->amount_basis);
        $this->applyCoreFilters($overall);
        $overall->whereBetween(DB::raw($date), [
            $year . '-01-01 00:00:00',
            $year . '-12-31 23:59:59',
        ]);
        $overallTotal = (float) $overall->selectRaw('COALESCE(SUM(' . $amount . '), 0) as amount')->value('amount');

        return [
            'mode' => 'annual',
            'entity' => $this->findEntity($request->dimension, $request->entity_id),
            'kpis' => [
                'total' => $total,
                'monthly_average' => $total / 12,
                'revenue_share' => abs($overallTotal) > 0.0001 ? ($total / $overallTotal) * 100 : 0,
            ],
            'chart' => [
                'labels' => range(1, 12),
                'datasets' => [[
                    'label' => $year . ' 年',
                    'data' => $months,
                ]],
            ],
            'rows' => collect(range(1, 12))->map(function ($month) use ($months) {
                return ['month' => $month, 'amount' => $months[$month - 1]];
            })->all(),
        ];
    }

    private function trend(Request $request)
    {
        $date = $this->transactionDateExpression('so');
        $amount = $this->amountExpression($request->amount_basis);
        $base = $this->lineQuery($request->amount_basis);
        $this->applyCoreFilters($base);
        $this->applyEntityFilter($base, $request->dimension, $request->entity_id);

        $bounds = (clone $base)->selectRaw(
            'MIN(YEAR(' . $date . ')) as min_year, MAX(YEAR(' . $date . ')) as max_year'
        )->first();
        $maxYear = $bounds && $bounds->max_year ? (int) $bounds->max_year : Carbon::now()->year;
        $minYear = $bounds && $bounds->min_year ? (int) $bounds->min_year : $maxYear;
        if ($request->recent_years !== 'all') {
            $minYear = max($minYear, $maxYear - ((int) $request->recent_years) + 1);
        }

        $values = (clone $base)
            ->whereBetween(DB::raw($date), [
                $minYear . '-01-01 00:00:00',
                $maxYear . '-12-31 23:59:59',
            ])
            ->selectRaw('YEAR(' . $date . ') as year, SUM(' . $amount . ') as amount')
            ->groupByRaw('YEAR(' . $date . ')')
            ->pluck('amount', 'year');

        $rows = [];
        for ($year = $minYear; $year <= $maxYear; $year++) {
            $rows[] = ['year' => $year, 'amount' => (float) ($values[$year] ?? 0)];
        }

        return [
            'mode' => 'trend',
            'entity' => $this->findEntity($request->dimension, $request->entity_id),
            'chart' => [
                'labels' => array_column($rows, 'year'),
                'datasets' => [[
                    'label' => '年度銷售額',
                    'data' => array_column($rows, 'amount'),
                ]],
            ],
            'rows' => $rows,
        ];
    }

    private function comparison(Request $request)
    {
        $yearA = (int) $request->year_a;
        $yearB = (int) $request->year_b;
        $startMonth = (int) $request->start_month;
        $endMonth = (int) $request->end_month;
        $date = $this->transactionDateExpression('so');
        $amount = $this->amountExpression($request->amount_basis);
        $query = $this->lineQuery($request->amount_basis);
        $this->applyCoreFilters($query);
        $this->applyEntityFilter($query, $request->dimension, $request->entity_id);
        $query->whereIn(DB::raw('YEAR(' . $date . ')'), [$yearA, $yearB])
            ->whereBetween(DB::raw('MONTH(' . $date . ')'), [$startMonth, $endMonth]);

        $values = $query
            ->selectRaw('YEAR(' . $date . ') as year, MONTH(' . $date . ') as month, SUM(' . $amount . ') as amount')
            ->groupByRaw('YEAR(' . $date . '), MONTH(' . $date . ')')
            ->get()
            ->keyBy(function ($row) {
                return $row->year . '-' . $row->month;
            });

        $rows = [];
        for ($month = $startMonth; $month <= $endMonth; $month++) {
            $a = (float) (optional($values->get($yearA . '-' . $month))->amount ?? 0);
            $b = (float) (optional($values->get($yearB . '-' . $month))->amount ?? 0);
            $difference = $a - $b;
            $percent = abs($b) > 0.0001 ? ($difference / abs($b)) * 100 : (abs($a) <= 0.0001 ? 0 : null);
            $rows[] = [
                'month' => $month,
                'year_a_amount' => $a,
                'year_b_amount' => $b,
                'difference' => $difference,
                'percent' => $percent,
            ];
        }

        return [
            'mode' => 'comparison',
            'entity' => $this->findEntity($request->dimension, $request->entity_id),
            'years' => [$yearA, $yearB],
            'chart' => [
                'labels' => array_column($rows, 'month'),
                'datasets' => [
                    ['label' => $yearA . ' 年', 'data' => array_column($rows, 'year_a_amount')],
                    ['label' => $yearB . ' 年', 'data' => array_column($rows, 'year_b_amount')],
                ],
            ],
            'rows' => $rows,
        ];
    }

    public function details(Request $request, $paginate = true, $limit = null)
    {
        list($query, $date, $amount, $quantity) = $this->detailQuery($request);
        $summary = (clone $query)->selectRaw(
            'COUNT(sod.id) as row_count, COUNT(DISTINCT so.id) as order_count, ' .
            'COALESCE(SUM(' . $quantity . '), 0) as quantity, COALESCE(SUM(' . $amount . '), 0) as amount'
        )->first();

        $select = [
            'sod.id', 'so.id as order_id', 'so.shown_id', 'so.status',
            'c.id as customer_id', 'c.name as customer_name',
            'p.id as product_id', 'p.shownID as product_code', 'p.name as product_name',
            'p.unit', 'sod.price', 'sod.discount',
            DB::raw('DATE(' . $date . ') as transaction_date'),
            DB::raw($quantity . ' as quantity'),
            DB::raw($amount . ' as amount'),
        ];
        $query->select($select);
        $this->applyDetailSorting($query, $request, $date, $amount, $quantity);

        if ($paginate) {
            $result = $query->paginate((int) ($request->per_page ?: 50), ['*'], 'page', (int) ($request->page ?: 1));
            $rows = collect($result->items())->map(function ($row) {
                return $this->formatDetail($row);
            })->all();
            $pagination = [
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'per_page' => $result->perPage(),
                'total' => $result->total(),
                'from' => $result->firstItem(),
                'to' => $result->lastItem(),
            ];
        } else {
            if ($limit) {
                $query->limit($limit);
            }
            $rows = $query->get()->map(function ($row) {
                return $this->formatDetail($row);
            })->all();
            $pagination = null;
        }

        return [
            'rows' => $rows,
            'summary' => [
                'row_count' => (int) $summary->row_count,
                'order_count' => (int) $summary->order_count,
                'quantity' => (float) $summary->quantity,
                'amount' => (float) $summary->amount,
            ],
            'pagination' => $pagination,
        ];
    }

    public function streamDetailRows(Request $request, callable $callback)
    {
        list($query, $date, $amount, $quantity) = $this->detailQuery($request);
        $query->select(
            'sod.id', 'so.id as order_id', 'so.shown_id', 'so.status',
            'c.id as customer_id', 'c.name as customer_name',
            'p.id as product_id', 'p.shownID as product_code', 'p.name as product_name',
            'p.unit', 'sod.price', 'sod.discount',
            DB::raw('DATE(' . $date . ') as transaction_date'),
            DB::raw($quantity . ' as quantity'),
            DB::raw($amount . ' as amount')
        );
        $this->applyDetailSorting($query, $request, $date, $amount, $quantity);
        $query->chunk(500, function ($rows) use ($callback) {
            foreach ($rows as $row) {
                $callback($this->formatDetail($row));
            }
        });
    }

    public function exportTable(Request $request, $detailLimit = null)
    {
        if ($request->tab === 'overview') {
            $result = $this->overview($request);
            $headers = array_merge(['實體名稱'], collect(range(1, 12))->map(function ($month) {
                return $month . '月';
            })->all(), ['年度總計']);
            $rows = collect($result['rows'])->map(function ($row) {
                return array_merge([$row['entity']['name']], $row['months'], [$row['total']]);
            })->all();
            return ['title' => '銷售分析－總覽', 'headers' => $headers, 'rows' => $rows, 'chart' => $result['chart']];
        }

        if ($request->tab === 'drilldown') {
            $result = $this->drilldown($request);
            if ($request->mode === 'comparison') {
                $headers = ['月份', $request->year_a . ' 年', $request->year_b . ' 年', '差異', '差異百分比'];
                $rows = collect($result['rows'])->map(function ($row) {
                    return [$row['month'], $row['year_a_amount'], $row['year_b_amount'], $row['difference'], is_null($row['percent']) ? 'N/A' : $row['percent'] . '%'];
                })->all();
            } elseif ($request->mode === 'trend') {
                $headers = ['年度', '銷售額'];
                $rows = collect($result['rows'])->map(function ($row) {
                    return [$row['year'], $row['amount']];
                })->all();
            } else {
                $headers = ['月份', '銷售額'];
                $rows = collect($result['rows'])->map(function ($row) {
                    return [$row['month'], $row['amount']];
                })->all();
            }
            return ['title' => '銷售分析－' . $result['entity']['name'], 'headers' => $headers, 'rows' => $rows, 'chart' => $result['chart']];
        }

        $result = $this->details($request, false, $detailLimit);
        $rows = collect($result['rows'])->map(function ($row) {
            return [
                $row['shown_id'], $row['transaction_date'], $row['order_type'],
                $row['customer_name'], $row['product_code'], $row['product_name'],
                $row['unit'], $row['quantity'], $row['price'], $row['discount'], $row['amount'],
            ];
        })->all();
        return [
            'title' => '銷售分析－交易明細',
            'headers' => ['銷貨單號', '日期', '單別', '顧客', '商品編號', '商品', '單位', '數量', '單價', '折數', '金額'],
            'rows' => $rows,
            'summary' => $result['summary'],
            'chart' => null,
        ];
    }

    public function findEntity($dimension, $entityId)
    {
        $table = $dimension === self::DIMENSION_CUSTOMER ? 'consumers' : 'products';
        $row = DB::table($table)->where('id', $entityId)->first();
        if (!$row) {
            $hasHistory = $dimension === self::DIMENSION_CUSTOMER
                ? DB::table('sales_orders')->where('consumer_id', $entityId)->exists()
                : DB::table('sales_order_details')->where('product_id', $entityId)->exists();
            if (!$hasHistory) {
                abort(404, '查無指定分析實體');
            }
            return [
                'id' => (int) $entityId,
                'name' => $dimension === self::DIMENSION_CUSTOMER
                    ? '（顧客資料已移除 #' . $entityId . '）'
                    : '（商品資料已移除 #' . $entityId . '）',
                'is_deleted' => true,
            ];
        }
        return [
            'id' => (int) $row->id,
            'name' => $row->name,
            'is_deleted' => !is_null($row->deleted_at),
        ];
    }

    private function lineQuery($amountBasis)
    {
        return DB::table('sales_orders as so')
            ->join('sales_order_details as sod', 'sod.sales_order_id', '=', 'so.id')
            ->leftJoin('consumers as c', 'c.id', '=', 'so.consumer_id')
            ->leftJoin('products as p', 'p.id', '=', 'sod.product_id');
    }

    private function orphanOverviewRows($dimension, $amountBasis, $start, $end, $excludeZero)
    {
        $date = $this->transactionDateExpression('so');
        $amount = $this->amountExpression($amountBasis);
        $query = DB::table('sales_orders as so')
            ->join('sales_order_details as sod', 'sod.sales_order_id', '=', 'so.id')
            ->where('so.confirmStatus', 1)
            ->whereIn('so.status', [1, 2])
            ->whereBetween(DB::raw($date), [$start, $end]);

        if ($dimension === self::DIMENSION_CUSTOMER) {
            $query->leftJoin('consumers as missing_entity', 'missing_entity.id', '=', 'so.consumer_id')
                ->whereNull('missing_entity.id');
            $entityId = 'so.consumer_id';
            $label = '顧客資料已移除';
        } else {
            $query->leftJoin('products as missing_entity', 'missing_entity.id', '=', 'sod.product_id')
                ->whereNull('missing_entity.id');
            $entityId = 'sod.product_id';
            $label = '商品資料已移除';
        }

        $select = [DB::raw($entityId . ' as entity_id')];
        for ($month = 1; $month <= 12; $month++) {
            $select[] = DB::raw('COALESCE(SUM(CASE WHEN MONTH(' . $date . ') = ' . $month . ' THEN ' . $amount . ' ELSE 0 END), 0) as month_' . $month);
        }
        $select[] = DB::raw('COALESCE(SUM(' . $amount . '), 0) as annual_total');
        $query->select($select)->groupBy($entityId);
        if ($excludeZero) {
            $query->havingRaw('ABS(annual_total) > 0.0001');
        }

        return $query->get()->map(function ($row) use ($label) {
            $months = [];
            for ($month = 1; $month <= 12; $month++) {
                $property = 'month_' . $month;
                $months[] = (float) $row->{$property};
            }
            return [
                'entity' => [
                    'id' => (int) $row->entity_id,
                    'name' => '（' . $label . ' #' . $row->entity_id . '）',
                    'is_deleted' => true,
                ],
                'months' => $months,
                'total' => (float) $row->annual_total,
            ];
        });
    }

    private function applyCoreFilters($query)
    {
        return $query->where('so.confirmStatus', 1)->whereIn('so.status', [1, 2]);
    }

    private function applyEntityFilter($query, $dimension, $entityId)
    {
        if ($dimension === self::DIMENSION_CUSTOMER) {
            $query->where('so.consumer_id', $entityId);
        } else {
            $query->where('sod.product_id', $entityId);
        }
        return $query;
    }

    private function detailQuery(Request $request)
    {
        $query = $this->lineQuery($request->amount_basis);
        $this->applyCoreFilters($query);
        if ($request->filled('entity_id')) {
            $this->applyEntityFilter($query, $request->dimension, $request->entity_id);
        }

        $date = $this->dateExpression($request->date_basis, 'so');
        $query->whereBetween(DB::raw($date), [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59',
        ]);

        switch ($request->order_status) {
            case 'unpaid':
                $query->whereNull('so.paid_at');
                break;
            case 'paid':
                $query->whereNotNull('so.paid_at');
                break;
            case 'undelivered':
                $query->whereNull('so.delivered_at');
                break;
            case 'completed':
                $query->whereNotNull('so.paid_at')->whereNotNull('so.delivered_at');
                break;
        }

        return [
            $query,
            $date,
            $this->amountExpression($request->amount_basis),
            '(CASE WHEN so.status = 2 THEN -1 ELSE 1 END) * sod.quantity',
        ];
    }

    private function applyDetailSorting($query, Request $request, $date, $amount, $quantity)
    {
        $direction = $request->sort_direction === 'asc' ? 'asc' : 'desc';
        $columns = [
            'transaction_date' => $date,
            'shown_id' => 'so.shown_id',
            'customer_name' => 'c.name',
            'product_name' => 'p.name',
            'quantity' => $quantity,
            'amount' => $amount,
        ];
        $column = $columns[$request->sort_by] ?? $date;
        $query->orderByRaw($column . ' ' . $direction)->orderBy('sod.id', 'desc');
    }

    private function formatDetail($row)
    {
        return [
            'id' => (int) $row->id,
            'order_id' => (int) $row->order_id,
            'shown_id' => $row->shown_id,
            'transaction_date' => $row->transaction_date,
            'order_type' => (int) $row->status === 2 ? '退貨' : '銷貨',
            'customer_id' => (int) $row->customer_id,
            'customer_name' => $row->customer_name ?: '（顧客資料已移除）',
            'product_id' => (int) $row->product_id,
            'product_code' => $row->product_code,
            'product_name' => $row->product_name ?: '（商品資料已移除）',
            'unit' => $this->unitLabel($row->unit),
            'quantity' => (float) $row->quantity,
            'price' => (float) $row->price,
            'discount' => (float) $row->discount,
            'amount' => (float) $row->amount,
            'show_url' => route((int) $row->status === 2 ? 'return.show' : 'sales.show', [$row->order_id]),
        ];
    }

    private function amountExpression($basis, $orderAlias = 'so', $detailAlias = 'sod', $guardNullOrder = false)
    {
        $value = $detailAlias . '.subTotal';
        if ($basis === self::BASIS_TAX_INCLUSIVE) {
            $value = '(CASE WHEN ' . $orderAlias . '.taxType = 1 THEN ' . $detailAlias . '.subTotal * 1.05 ELSE ' . $detailAlias . '.subTotal END)';
        }
        $signed = '(CASE WHEN ' . $orderAlias . '.status = 2 THEN -1 ELSE 1 END) * ' . $value;
        return $guardNullOrder
            ? '(CASE WHEN ' . $orderAlias . '.id IS NULL THEN 0 ELSE ' . $signed . ' END)'
            : $signed;
    }

    private function transactionDateExpression($alias)
    {
        return '(CASE WHEN ' . $alias . '.status = 2 THEN COALESCE(' . $alias . '.transaction_at, ' . $alias . '.created_at) ELSE ' . $alias . '.transaction_at END)';
    }

    private function dateExpression($basis, $alias)
    {
        if ($basis === 'delivered') {
            return $alias . '.delivered_at';
        }
        if ($basis === 'paid') {
            return $alias . '.paid_at';
        }
        if ($basis === 'created') {
            return $alias . '.created_at';
        }
        return $this->transactionDateExpression($alias);
    }

    private function unitLabel($unit)
    {
        return [
            'package' => '包',
            'kg' => '公斤',
            'roll' => '捲',
        ][$unit] ?? '個';
    }

    private function displayMonthsForYear($year)
    {
        $today = Carbon::now('Asia/Taipei');
        return (int) $year === $today->year ? range(1, $today->month) : range(1, 12);
    }
}

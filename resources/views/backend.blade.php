@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <style>
        .dashboard-kpi { border-left: .3rem solid #4e73df; }
        .dashboard-kpi.kpi-info { border-left-color: #36b9cc; }
        .dashboard-kpi.kpi-warning { border-left-color: #f6c23e; }
        .dashboard-kpi.kpi-danger { border-left-color: #e74a3b; }
        .dashboard-kpi .kpi-label { color: #5a5c69; font-size: .78rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
        .dashboard-kpi .kpi-value { color: #2e3440; font-size: 1.45rem; font-weight: 700; font-variant-numeric: tabular-nums; }
        .dashboard-kpi .kpi-icon { color: #d1d3e2; font-size: 2rem; }
        .dashboard-chart-wrap { height: 330px; }
        .dashboard-section-title { color: #4e5d78; font-size: .9rem; font-weight: 700; }
        .dashboard-alert-item { color: inherit; transition: background-color .15s ease-in-out; }
        .dashboard-alert-item:hover { color: inherit; text-decoration: none; background: #f8f9fc; }
        .dashboard-alert-icon { display: inline-flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; border-radius: 50%; flex: 0 0 2rem; }
        .dashboard-alert-icon.overdue { color: #e74a3b; background: #fdecea; }
        .dashboard-alert-icon.stock { color: #b7791f; background: #fff4d6; }
        .dashboard-list-name { min-width: 0; }
        .dashboard-list-name strong { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .dashboard-amount { font-variant-numeric: tabular-nums; white-space: nowrap; }
        .dashboard-stock-levels { max-height: 390px; overflow-y: auto; }
        .dashboard-progress { height: .45rem; background: #eaecf4; }
        .dashboard-progress .progress-bar { min-width: 2px; }
        .dashboard-empty { color: #858796; padding: 1.5rem; text-align: center; }
    </style>
@endpush

@section('content')
    @php
        $formatNumber = function ($value) {
            return rtrim(rtrim(number_format((float) $value, 2, '.', ','), '0'), '.');
        };
        $formatMoney = function ($value) use ($formatNumber) {
            return '$' . $formatNumber($value);
        };
        $yearOverYear = $dashboard['sales']['year_over_year'];
    @endphp

    @component('components.breadcrumbs')
        <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        <li class="breadcrumb-item active">經營概況</li>
    @endcomponent

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1 text-gray-800">經營管理 Dashboard</h1>
            <div class="small text-muted">資料更新時間：{{ $dashboard['generated_at'] }}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-kpi shadow-sm h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="kpi-label mb-1">本月營收</div>
                            <div class="kpi-value">{{ $formatMoney($dashboard['sales']['current_month']) }}</div>
                            <div class="small mt-2 {{ is_null($yearOverYear) ? 'text-muted' : ($yearOverYear > 0 ? 'text-danger' : ($yearOverYear < 0 ? 'text-success' : 'text-muted')) }}">
                                @if (is_null($yearOverYear))
                                    去年同期無資料
                                @elseif ($yearOverYear > 0)
                                    <i class="fas fa-arrow-up mr-1"></i>年增 {{ $formatNumber(abs($yearOverYear)) }}%
                                @elseif ($yearOverYear < 0)
                                    <i class="fas fa-arrow-down mr-1"></i>年減 {{ $formatNumber(abs($yearOverYear)) }}%
                                @else
                                    與去年同期持平
                                @endif
                            </div>
                        </div>
                        <div class="col-auto kpi-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card dashboard-kpi kpi-info shadow-sm h-100 text-decoration-none" href="{{ route('reports.account.receivable') }}">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="kpi-label mb-1">應收帳款餘額</div>
                            <div class="kpi-value">{{ $formatMoney($dashboard['receivables']['balance']) }}</div>
                            <div class="small text-muted mt-2">{{ $dashboard['receivables']['customer_count'] }} 位未結清客戶</div>
                        </div>
                        <div class="col-auto kpi-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-kpi kpi-danger shadow-sm h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="kpi-label text-danger mb-1">逾期應收</div>
                            <div class="kpi-value text-danger">{{ $formatMoney($dashboard['overdue']['balance']) }}</div>
                            <div class="small text-danger mt-2">{{ $dashboard['overdue']['customer_count'] }} 位客戶超過 {{ $dashboard['settings']['overdue_days'] }} 天</div>
                        </div>
                        <div class="col-auto kpi-icon"><i class="fas fa-exclamation-triangle text-danger"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card dashboard-kpi kpi-warning shadow-sm h-100 text-decoration-none" href="{{ route('materials.index') }}">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="kpi-label text-warning mb-1">原物料低庫存</div>
                            <div class="kpi-value">{{ $dashboard['materials']['low_stock_count'] }} 項</div>
                            <div class="small text-muted mt-2">僅計安全庫存量大於 0 的原料</div>
                        </div>
                        <div class="col-auto kpi-icon"><i class="fas fa-box-open text-warning"></i></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-7 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-chart-line text-primary mr-2"></i><strong>近 12 個月營收趨勢</strong>
                        <div class="small text-muted mt-1">未稅淨銷售額，退貨已扣除</div>
                    </div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('reports.sales.analysis', ['tab' => 'overview', 'dimension' => 'customer', 'amount_basis' => 'pre_tax', 'year' => $dashboard['year']]) }}">查看詳細</a>
                </div>
                <div class="card-body dashboard-chart-wrap">
                    <canvas id="dashboardRevenueChart"
                            data-labels='@json(array_column($dashboard['sales']['trend'], 'label'))'
                            data-values='@json(array_column($dashboard['sales']['trend'], 'amount'))'></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <i class="fas fa-clipboard-list text-danger mr-2"></i><strong>待辦／警示</strong>
                    <div class="small text-muted mt-1">需要管理者主動處理的事項</div>
                </div>
                <div class="card-body p-0">
                    <div class="px-3 pt-3 pb-2 dashboard-section-title">逾期應收</div>
                    <div class="list-group list-group-flush">
                        @forelse ($dashboard['overdue']['items'] as $item)
                            <a class="list-group-item list-group-item-action dashboard-alert-item d-flex align-items-center"
                               href="{{ route('reports.sales.analysis', ['tab' => 'drilldown', 'dimension' => 'customer', 'amount_basis' => 'pre_tax', 'entity_id' => $item['consumer_id'], 'mode' => 'annual', 'year' => $dashboard['year']]) }}">
                                <span class="dashboard-alert-icon overdue mr-3"><i class="fas fa-exclamation"></i></span>
                                <span class="dashboard-list-name d-flex flex-column flex-grow-1 mr-2">
                                    <strong>{{ $item['customer_name'] }}</strong>
                                    <small class="text-danger">逾期 {{ $item['overdue_days'] }} 天</small>
                                </span>
                                <strong class="dashboard-amount text-danger">{{ $formatMoney($item['amount']) }}</strong>
                            </a>
                        @empty
                            <div class="dashboard-empty py-3"><i class="far fa-check-circle mr-1"></i>目前沒有逾期應收</div>
                        @endforelse
                    </div>
                    @if ($dashboard['overdue']['remaining_count'] > 0)
                        <div class="small text-muted px-3 py-2 border-top">還有 {{ $dashboard['overdue']['remaining_count'] }} 位逾期客戶</div>
                    @endif

                    <div class="px-3 pt-3 pb-2 border-top dashboard-section-title">原物料低庫存</div>
                    <div class="list-group list-group-flush">
                        @forelse ($dashboard['materials']['low_stock_items'] as $item)
                            <a class="list-group-item list-group-item-action dashboard-alert-item d-flex align-items-center"
                               href="{{ route('materials.show', [$item['id']]) }}">
                                <span class="dashboard-alert-icon stock mr-3"><i class="fas fa-box"></i></span>
                                <span class="dashboard-list-name d-flex flex-column flex-grow-1 mr-2">
                                    <strong>{{ $item['name'] }}</strong>
                                    <small class="text-muted">安全量 {{ $formatNumber($item['safe_quantity']) }} {{ $item['unit'] }}</small>
                                </span>
                                <strong class="dashboard-amount text-danger">{{ $formatNumber($item['stock']) }} {{ $item['unit'] }}</strong>
                            </a>
                        @empty
                            <div class="dashboard-empty py-3"><i class="far fa-check-circle mr-1"></i>目前沒有低庫存原物料</div>
                        @endforelse
                    </div>
                    @if ($dashboard['materials']['remaining_low_stock_count'] > 0)
                        <a class="d-block small px-3 py-2 border-top" href="{{ route('materials.index') }}">還有 {{ $dashboard['materials']['remaining_low_stock_count'] }} 項，查看原物料列表</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <i class="fas fa-trophy text-warning mr-2"></i><strong>本月 Top 5 顧客</strong>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($dashboard['sales']['top_customers'] as $index => $customer)
                        <a class="list-group-item list-group-item-action d-flex align-items-center"
                           href="{{ route('reports.sales.analysis', ['tab' => 'drilldown', 'dimension' => 'customer', 'amount_basis' => 'pre_tax', 'entity_id' => $customer['id'], 'mode' => 'annual', 'year' => $dashboard['year']]) }}">
                            <span class="badge badge-{{ $index === 0 ? 'warning' : 'light' }} border mr-3">{{ $index + 1 }}</span>
                            <span class="flex-grow-1 text-truncate mr-3">{{ $customer['name'] }}</span>
                            <strong class="dashboard-amount">{{ $formatMoney($customer['amount']) }}</strong>
                        </a>
                    @empty
                        <div class="dashboard-empty">本月尚無銷售資料</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-boxes text-info mr-2"></i><strong>原物料庫存水位</strong></span>
                    <small class="text-muted">目前庫存／安全庫存</small>
                </div>
                <div class="dashboard-stock-levels">
                    <div class="list-group list-group-flush">
                        @forelse ($dashboard['materials']['levels'] as $item)
                            <a class="list-group-item list-group-item-action" href="{{ route('materials.show', [$item['id']]) }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-truncate mr-3 {{ $item['is_low'] ? 'text-danger' : '' }}">{{ $item['name'] }}</strong>
                                    <span class="dashboard-amount {{ $item['is_low'] ? 'text-danger font-weight-bold' : 'text-muted' }}">
                                        {{ $formatNumber($item['stock']) }} / {{ $formatNumber($item['safe_quantity']) }} {{ $item['unit'] }}
                                    </span>
                                </div>
                                <div class="progress dashboard-progress">
                                    <div class="progress-bar {{ $item['is_low'] ? 'bg-danger' : 'bg-success' }}"
                                         role="progressbar"
                                         style="width: {{ min(100, max(0, $item['ratio'] * 100)) }}%"
                                         aria-valuenow="{{ $item['ratio'] * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        @empty
                            <div class="dashboard-empty">尚未設定任何原物料安全庫存量</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

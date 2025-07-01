@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/sales/month.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Sales Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Monthly Report') }}</li>
    @endcomponent

    <div id="reports">
        <span id="getSalesMonthData" class="d-none">{{ route('reports.sales.month') }}</span>
        <span id="getSalesMonthTrendData" class="d-none">{{ route('reports.sales.monthTrend') }}</span>
        <sales-month :reports="reports" :infos="infos" :query-args="queryArgs" :chart="chart" @fetch-data="fetchData" @get-trend-data="getTrendData">
        </sales-month>
    </div>

@endsection

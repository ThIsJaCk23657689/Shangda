@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/sales/daily.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Sales Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Daily Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getSalesDailyData" class="d-none">{{ route('reports.sales.daily') }}</span>

        <sales-daily
            :reports="reports"
            :filters="filters"
            v-on:refresh-data="refreshData">
        </sales-daily>
    </div>

@endsection

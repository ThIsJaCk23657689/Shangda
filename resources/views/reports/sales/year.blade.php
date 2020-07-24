@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
    <script src="{{ asset('js/reports/sales/year.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Sales Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Annual Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getSalesYearData" class="d-none">{{ route('reports.sales.year') }}</span>

        <sales-year
            :reports="reports"
            :filters="filters"
            :month_total="month_total"
            v-on:refresh-data="refresh-data">
        </sales-year>
    </div>

@endsection

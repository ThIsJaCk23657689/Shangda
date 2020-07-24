@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/purchase/year.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Purchase Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Annual Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getPurchaseYearData" class="d-none">{{ route('reports.purchase.year') }}</span>

        <purchase-year
            :reports="reports"
            :filters="filters"
            :month_total="month_total"
            v-on:refresh-data="refreshData">
        </purchase-year>
    </div>

@endsection

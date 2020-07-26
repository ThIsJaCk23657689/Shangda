@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/purchase/daily.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Purchase Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Daily Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getPurchaseDailyData" class="d-none">{{ route('reports.purchase.daily') }}</span>

        <purchase-daily
            :reports="reports"
            :filters="filters"
            v-on:refresh-data="refreshData">
        </purchase-daily>
    </div>

@endsection

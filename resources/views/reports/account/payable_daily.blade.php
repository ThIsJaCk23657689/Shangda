@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/account/payble_daily.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
    <li class="breadcrumb-item">{{ __('Report') }}</li>
    <li class="breadcrumb-item">{{ __('Account Report') }}</li>
    <li class="breadcrumb-item active">{{ __('Accounts Payable Daily Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getPayableDailyData" class="d-none">{{ route('reports.account.payable.daily') }}</span>

        <payable-daily
            :reports="reports"
            :filters="filters"
            v-on:refresh-data="refreshData">
        </payable-daily>
    </div>

@endsection

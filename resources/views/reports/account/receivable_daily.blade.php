@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/account/receivable_daily.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
    <li class="breadcrumb-item">{{ __('Report') }}</li>
    <li class="breadcrumb-item">{{ __('Account Report') }}</li>
    <li class="breadcrumb-item active">{{ __('Accounts Receivable Daily Report') }}</li>
    @endcomponent

    <div id="reports">

        <span id="getReceivableDailyData" class="d-none">{{ route('reports.account.receivable.daily') }}</span>

        <receivable-daily
            :reports="reports"
            :filters="filters"
            v-on:refresh-data="refreshData">
        </receivable-daily>
    </div>

@endsection

@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/orders/billing/index.js') }}" defer></script>
@endpush

@section('content')

    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('Orders Management') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('billing.index') }}">{{ __('Billing Statement') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('Index') }}</li>
    @endcomponent

    <div id="billing">
        <span id="getConsumersName" style="display: none;">{{ route('consumers.showName') }}</span>
        <span id="getConsumerInfo" style="display: none;">{{ route('consumers.getInfo') }}</span>

        <span id="getBillingPDF" style="display: none;">{{ route('billing.pdf') }}</span>

        <billing-index-list :consumers="consumers"></billing-index-list>
    </div>

    @include('partials.backend.modals.purchase.received')
    @include('partials.backend.modals.purchase.paid')

@endsection

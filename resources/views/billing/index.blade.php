@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/orders/purchase/index.js') }}" defer></script>
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

    <div id="">

    </div>

    @include('partials.backend.modals.purchase.received')
    @include('partials.backend.modals.purchase.paid')

@endsection

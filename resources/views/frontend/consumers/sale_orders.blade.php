@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/consumers/sale_orders.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/sale_orders.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="sale-orders-header">
    <div class="container">
        <h2 class="title">所有訂單</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="consumer-sale-orders" >
    <div id="sale-orders" class="container sale-orders-container">
        <span id="getSaleOrdersFrontend" class="d-none">{{ route('consumer.getSaleOrdersFrontend') }}</span>
        <span id="getConsumerID" class="d-none">{{ $consumer_id }}</span>

        <sale-order-filter :filter="filter" v-on:change-status="changeStatus"></sale-order-filter>
        <sale-orders-container :sale-orders="saleOrders"></sale-orders-container>
        <content-paginate :current-page="currentPage" :total-page="totalPage" v-on:chage-page="chagePage"></content-paginate>
    </div>

</section>


@endsection

@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/products/index.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('css/frontend/products/index.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <section class="header">
        <div class="container">
            <h2 class="title">商品總覽</h2>
        </div>
        <div class="bg-image"></div>
        <div class="bg-gray"></div>
    </section>

    <section class="product-content">
        <div id="product" class="container">

            <span id="GetProductsList" class="d-none">{{ route('front.products.index') }}</span>

            <product-filter :filter="filter" v-on:refresh-product="refreshProduct"></product-filter>

            <product-container :products="products"></product-container>
            <content-paginate :current-page="currentPage" :total-page="totalPage" v-on:chage-page="chagePage"></content-paginate>

        </div>
    </section>
@endsection

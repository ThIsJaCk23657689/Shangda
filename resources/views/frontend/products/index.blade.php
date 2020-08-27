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
            <h3 class="title" style="font-size: 2rem;">如需客製化商品，請聯絡我們。</h3>
        </div>
        <div class="bg-image"></div>
        <div class="bg-gray"></div>
    </section>

    <section class="product-content">
        <div id="product" class="container">

            <span id="GetProductsList" class="d-none">{{ route('front.products.index') }}</span>
            <span id="AddProductToCartURL" class="d-none">{{ route('front.cart.add') }}</span>
            <span id="ConsumerLoginURL" class="d-none">{{ route('consumers.login') }}</span>
            <span id="ContactStoreURL" class="d-none">{{ route('front.contacts.store') }}</span>
            {{-- <marquee direction="right" behavior="alternate" width="300" height="auto" scrollamount="7">如需客製化商品。請聯絡我們。</marquee> --}}
            <product-filter :filter="filter" v-on:refresh-product="refreshProduct"></product-filter>

            <product-container :products="products"></product-container>
            <content-paginate :current-page="currentPage" :total-page="totalPage" v-on:chage-page="chagePage"></content-paginate>

            <contact-form></contact-form>

            <div class="costomer-div text-center">
                <a href="{{ route('front.contact') }}">
                    <div class="row row-i">
                        <i class="fas fa-phone"></i>
                    </div>
                    {{-- <div class="row row-span">
                        <span>如需客製化商品。請聯絡我們。</span>
                    </div> --}}
                </a>

            </div>
        </div>
    </section>
@endsection

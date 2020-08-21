@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/consumers/cart.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/cart.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <section class="header">
        <div class="container">
            <h2 class="title">購物車</h2>
        </div>
        <div class="bg-image"></div>
        <div class="bg-gray"></div>
    </section>

    <section class="cart-content">
        <div id="cart" class="container">
            <span id="CartGetOneURL" class="d-none">{{ route('front.cart.getOne') }}</span>
            <span id="RemoveProductURL" class="d-none">{{ route('front.cart.remove') }}</span>
            <span id="UpdateProductQtyURL" class="d-none">{{ route('front.cart.update') }}</span>
            <span id="CheckOutURL" class="d-none">{{ route('front.cart.checkout') }}</span>

            <cart-table :carts="carts" :status="status"></cart-table>
        </div>
    </section>
@endsection
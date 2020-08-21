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
            @foreach ($cart->products as $product)
                <div style="color: #000000">
                    {{ $product }}<br />
                </div>
            @endforeach
        </div>
    </section>
@endsection
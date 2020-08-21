@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('vendor/smoothproducts/js/smoothproducts.js') }}" defer></script> --}}
    <script src="{{ asset('vendor/smoothproducts/js/smoothproducts.min.js') }}" defer></script>
    <script src="{{ asset('js/frontend/products/show.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('vendor/smoothproducts/css/smoothproducts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/frontend/products/show.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="header">
    <div class="container">
        <h2 class="title">商品資訊</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>

<div id="product-detail">
    <span id="getOnePictures" style="display: none;">{{ route('front.products.getOnePictures', [$product->id]) }}</span>

    <section class="product-detail-section" >
        <span id="getOnePictures" style="display: none;">{{ route('front.products.getOnePictures', [$product->id]) }}</span>
        <div class="container product-detail-container">
            <div class="row product-detail-row">
                <div class="col-md-6 product-left">
                    {{-- <div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div> --}}
                    <div class="sp-wrap">
                        @foreach ($product->imgs as $imgs)
                            <a href={{ asset($imgs) }} class="sp-default"><img src={{ asset($imgs) }} alt=""></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 product-right">
                    
                    @if(!$product->isPublic)
                        <div class="product-cart-btn text-center">
                            <a href="#" id="add-to-cart">
                                <div class="row">
                                    <img src="{{ asset('images/icons/cart_icon.png') }}" alt="">
                                </div>
                                <div class="row">
                                    <span class="button-text">加入購物車</span>
                                </div>
                                <span id="AddProductToCartURL" class="d-none">{{ route('front.cart.add') }}</span>
                                <span id="ProductID" class="d-none">{{ $product->id }}</span>
                            </a>
                        </div>
                    @else
                        <div class="product-cart-btn text-center">
                            <a href="#" id="add-to-cart">
                                <div class="row">
                                    <img src="{{ asset('images/icons/cart_icon.png') }}" alt="">
                                </div>
                                <div class="row">
                                    <span class="button-text">詢問價錢</span>
                                </div>
                                <span id="ProductID" class="d-none">{{ $product->id }}</span>
                            </a>
                        </div>
                    @endif

                    <div class="product-info">
                        <div class="row">
                            <h2>{{ $product->name }}</h2>
                        </div>
                        <div class="row">
                            <p>商品編號 : {{ $product->shownID ?? "無"}}</p>
                        </div>
                        <div class="row">
                            <p>商品規格 : {{ $product->specification ?? "無"}}</p>
                        </div>
                        <div class="row">
                            <p>商品花樣/顏色 : {{ $product->color ?? "無"}}</p>
                        </div>
                        <div class="row">
                            <p>商品尺寸(長/寬/折角) : {{ $product->length ?? "無"}} / {{ $product->width ?? "無"}} / {{ $product->chamfer ?? "無"}} (單位 : 公分)</p>
                        </div>
                        <div class="row">
                            <p>商品重量 : {{ $product->weight }} (單位 : 台兩)</p>
                        </div>
                        <div class="row">
                            <p>每件數量/單位 : {{ $product->qty_per_pack ?? "無"}}/ {{ $product->showUnit() }}</p>
                        </div>
                        <div class="row">
                            <p>商品簡介 : {{ $product->intro ?? "無" }}</p>
                        </div>
                        @if ($product->showPrice)
                            <div class="row">
                                <p>商品價格 : {{ $product->retailPrice }}</p>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


@endsection

@extends('layouts.frontend.master')

@push('CustomJS')

    {{-- <script src="{{ asset('vendor/smoothproducts/js/smoothproducts.js') }}" defer></script> --}}
    <script src="{{ asset('vendor/smoothproducts/js/smoothproducts.min.js') }}" defer></script>
    <script src="{{ asset('js/frontend/products/show.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/products/show.css') }}" rel="stylesheet" type="text/css">
    <link href="{{  asset('vendor/smoothproducts/css/smoothproducts.css') }}" rel="stylesheet" type="text/css">
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

    <section class="product-detail" >
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
                    <div class="product-info">
                        <div class="row">
                            <h2>{{ $product->name }}</h2>
                        </div>
                        <div class="row">
                            <p>商品編號 : {{ $product->shownID }}</p>
                        </div>
                        <div class="row">
                            <p>商品規格 : {{ $product->shownID }}</p>
                        </div>
                        <div class="row">
                            <p>商品花樣/顏色 : {{ $product->shownID }}</p>
                        </div>
                        <div class="row">
                            <p>商品尺寸(寬/高/折角) : {{ $product->shownID }} (單位 : 公分)</p>
                        </div>
                        <div class="row">
                            <p>商品重量 : {{ $product->shownID }} (單位 : 公克)</p>
                        </div>
                        <div class="row">
                            <p>每件數量/單位 : {{ $product->shownID }}/ {{ $product->shownID }}</p>
                        </div>
                        <div class="row">
                            <p>商品簡介 : {{ $product->shownID }}</p>
                        </div>
                        <div class="row">
                            <p>商品價格 : {{ $product->shownID }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>



<section class="detail-page-body">
    {{-- <div class="container">
        <div class="goback-container text-center">
            <a href="#" class="goback-text" onclick="history.go(-1); event.preventDefault();">
                <i class="fas fa-arrow-left"></i>
                返回上一頁
            </a>
        </div>
    </div> --}}
</section>


@endsection

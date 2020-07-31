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

    <section class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">

                        <div id="make-3D-space">
                            <div id="product-card">
                                <div id="product-front">
                                    <div class="shadow"></div>
                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt.png" alt="" />
                                    <div class="image_overlay"></div>
                                    <div id="view_details">View details</div>
                                    <div class="stats">        	
                                        <div class="stats-container">
                                            <span class="product_price">$39</span>
                                            <span class="product_name">Adidas Originals</span>    
                                            <p>Men's running shirt</p>                                            
                                            
                                            <div class="product-options">
                                                <strong>SIZES</strong>
                                                <span>XS, S, M, L, XL, XXL</span>
                                                <strong>COLORS</strong>
                                                <div class="colors">
                                                    <div class="c-blue"><span></span></div>
                                                    <div class="c-red"><span></span></div>
                                                    <div class="c-white"><span></span></div>
                                                    <div class="c-green"><span></span></div>
                                                </div>
                                            </div>                       
                                        </div>                         
                                    </div>
                                </div>
                                <div id="product-back">
                                    <div class="shadow"></div>
                                    <div id="carousel">
                                        <ul>
                                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large.png" alt="" /></li>
                                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large2.png" alt="" /></li>
                                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large3.png" alt="" /></li>
                                        </ul>
                                        <div class="arrows-perspective">
                                            <div class="carouselPrev">
                                                <div class="y"></div>
                                                <div class="x"></div>
                                            </div>
                                            <div class="carouselNext">
                                                <div class="y"></div>
                                                <div class="x"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="flip-back">
                                        <div id="cy"></div>
                                        <div id="cx"></div>
                                    </div>
                                </div>	  
                            </div>	
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

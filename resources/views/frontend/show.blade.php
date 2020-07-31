@extends('layouts.frontend.master')

@push('CustomCSS')
    <link href="{{  asset('css/frontend/product/show.css') }}" rel="stylesheet" type="text/css">
@endpush


@section('content')
<section class="product-detail">

</section>

<section class="detail-page-body">
    <div class="container">
        <div class="goback-container text-center">
            <a href="#" class="goback-text" onclick="history.go(-1); event.preventDefault();">
                <i class="fas fa-arrow-left"></i>
                返回上一頁
            </a>
        </div>
    </div>
</section>


@endsection

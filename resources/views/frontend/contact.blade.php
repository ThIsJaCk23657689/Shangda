@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/frontend/products/show.js') }}" defer></script> --}}
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/contact.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="header">
    <div class="container">
        <h2 class="title">聯絡我們</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="about-detail" >
    <div class="container about-detail-container">
        <div class="about-content">
            <div class="row">
                <div class="col-md-6 contact-info">
                    <h2>聯絡方式</h2>
                    <p>電話 : <a href="tel:03-755-0448">(03) 755 0448</a></p>
                    <p>傳真 : <a href="tel:03-755-0448">(03) 755 0448</a></p>
                    <p>營業時間 : 08:00-20:00</p>
                    <p>地址 : 350 苗栗縣竹南鎮國泰路43號</p>
                </div>
                <div class="col-md-6 contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3625.419209010048!2d120.8753165148343!3d24.67811208414028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3469b3214f5c27ed%3A0x989c7ff69392efca!2z5bCa6YGU5aGR6Iag5pyJ6ZmQ5YWs5Y-4!5e0!3m2!1szh-TW!2stw!4v1596435467114!5m2!1szh-TW!2stw" width="480" height="360" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

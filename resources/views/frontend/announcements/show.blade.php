@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/frontend/products/show.js') }}" defer></script> --}}
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/announcements/show.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="header">
    <div class="container">
        <h2 class="title">最新消息</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="announcement-detail" >
    <div class="container announcement-detail-container">
        <div class="announcement-title">
            <div class="announcement-detail-title-text text-center">
                <h1>{{ $announcement->title }}</h1>
            </div>
        </div>
        <div class="announcement-date">
            <div class="row text-right">
                <div class="col-md-12">
                    日期 : {{ $announcement->showDate() }}
                </div>
            </div>
        </div>
        <div class="announcement-content">
            <div class="row">
                <div class="col-md-12">
                    {{ $announcement->content }}
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

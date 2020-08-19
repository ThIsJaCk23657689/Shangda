@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/announcements/index.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('css/frontend/announcements/index.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <section class="header">
        <div class="container">
            <h2 class="title">最新消息</h2>
        </div>
        <div class="bg-image"></div>
        <div class="bg-gray"></div>
    </section>

    <section class="announcement-content">
        <div id="announcement" class="container">

            <span id="GetAnnoucementsList" class="d-none">{{ route('front.announcements.index') }}</span>

            <announcement-filter :filter="filter" v-on:refresh-announcement="refreshAnnouncement"></announcement-filter>

            <announcement-container :announcements="announcements"></announcement-container>
            <content-paginate :current-page="currentPage" :total-page="totalPage" v-on:chage-page="chagePage"></content-paginate>

        </div>
    </section>
@endsection

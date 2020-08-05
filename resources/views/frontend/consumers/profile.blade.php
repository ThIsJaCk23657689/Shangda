@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/frontend/products/show.js') }}" defer></script> --}}
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/profile.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="profile-header">
    <div class="container">
        <h2 class="title">個人資料</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="consumer-profile" >
    <div class="container profile-container">
        <div class="profile-subtitle text-left">
            <h3><i class="fas fa-user-circle"></i>基本資訊</h3>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-2 profile-img">
                    <div class="profile-content-img">
                        <img src="{{ asset($consumer->showPicture()) }}" width="100%" alt="">
                    </div>
                </div>
                <div class="col-md-10">
                    @if ($consumer->account_type == 0)
                    {{-- 個人帳號 --}}
                    <div class="row">
                        <div class="col-md-6">
                            <p>名稱 : {{ $consumer->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>簡稱 : {{ $consumer->shortName ?? "無" }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>性別 : {{ $consumer->showGender() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>生日 : {{ $consumer->birthday ?? "無" }}</p>
                        </div>
                    </div>
                    @else
                    {{-- 法人帳號 --}}
                    <div class="row">
                        <div class="col-md-12">
                            <p>公司名稱 : {{ $consumer->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>簡稱 : {{ $consumer->shortName ?? "無" }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>分店名 : {{ $consumer->branch ?? "無"}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>統一編號 : {{ $consumer->taxID ?? "無" }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>公司負責人名稱 : {{ $consumer->principal ?? "無"}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>聯絡人名稱 : {{ $consumer->operator_name ?? "無" }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>聯絡人性別 : {{ $consumer->showGender() ?? "無" }}</p>
                        </div>

                    </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="profile-subtitle text-left">
            <h3><i class="fas fa-phone-square-alt"></i>聯絡資訊</h3>
        </div>
        <div class="profile-content">
            @if ($consumer->account_type == 0)
            {{-- 個人帳號 --}}
            <div class="row">
                <div class="col-md-6">
                    <p>信箱 : {{ $consumer->email }}</p>
                </div>
                <div class="col-md-6">
                    <p>Line ID : {{ $consumer->lineID ?? "無" }}</p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>手機 : {{ $consumer->phone ?? "無" }}</p>
                </div>
                <div class="col-md-6">
                    <p>地址 : {{ $consumer->showAddress() }}</p>
                </div>
            </div>
            @else
            {{-- 法人帳號 --}}
            <div class="row">
                <div class="col-md-6">
                    <p>公司信箱 : {{ $consumer->email }}</p>
                </div>
                <div class="col-md-6">
                    <p>Line ID : {{ $consumer->lineID ?? "無" }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>公司電話 : {{ $consumer->tel }}</p>
                </div>
                <div class="col-md-6">
                    <p>公司傳真 : {{ $consumer->tax ?? "無" }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>公司地址 : {{ $consumer->showAddress() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>送貨地址 : {{ $consumer->showDeliveryAddress() }}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="profile-subtitle text-left">
            <h3><i class="fas fa-compass"></i>其他資訊</h3>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-4">
                    @if ($consumer->monthlyCheckDate != 0)
                    <p>月結日 : 每月 {{ $consumer->monthlyCheckDate }} 日</p>
                    @else
                    <p>月結日 : 無</p>
                    @endif

                </div>
                <div class="col-md-4">
                    <p>未沖帳總額 : {{ $consumer->uncheckedAmount ?? "0" }}</p>
                </div>
                <div class="col-md-4">
                    <p>總消費額 : {{ $consumer->totalConsumption ?? "0" }}</p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

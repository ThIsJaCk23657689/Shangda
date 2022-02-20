@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/frontend/products/show.js') }}" defer></script> --}}
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/about.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="header">
    <div class="container">
        <h2 class="title">關於尚達</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="about-detail" >
    <div class="container about-detail-container">
        <div class="about-content">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('/images/background/welcome.jpg') }}" alt="">
                </div>
                <div class="col-md-6 about-info">
                    <h2>關於尚達</h2>
                    <p class="upper_p">
                        尚達塑膠秉持著【積極向上】的態度傳承下去，對於塑膠袋的品質是非常的講究，一絲都不會馬虎，就只為了我們最誠敬的顧客們，
                        自民國 88 年成立自今，累積了 20 年以上的專業製造經驗，加上頂級的生產設備、 高品質的進口原料以及精益求精的工作態度，
                        尚達能製造出價格親民且品質強韌耐用的塑膠袋，除此之外我們尚達的塑膠袋是絕對無毒可以安心使用！
                    </p>
                    <p class="lower_p">相信尚達，天天發達。</p>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

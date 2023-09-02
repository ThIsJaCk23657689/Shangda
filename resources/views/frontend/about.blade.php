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
                <div class="col-md-12 mb-2">
                    <img src="{{ asset('/images/background/welcome.jpg') }}" alt="">
                </div>
                <div class="col-md-12 about-info">
                    <h2>關於尚達</h2>
                    <p class="upper_p">尚達塑膠有限公司 - 創造耐用、實用的塑膠袋自民國 88 年以來。</p>
                    <p class="upper_p">在過去的 24 年中，我們一直以最高的專業水準製造各種優質塑膠袋，為我們的客戶提供持久且實用的解決方案。我們深耕於塑膠製造領域，不斷努力提高產品品質，以確保我們的塑膠袋在各種應用場景中都能表現出色。</p>
                    <p class="upper_p">我們以客戶需求為首要，提供各種規格、款式和設計的塑膠袋，以滿足不同行業和用途的需求。無論您是需要高品質的購物袋、環保袋、包裝袋還是特殊用途的袋子，我們都能提供完美的解決方案。</p>
                    <p class="upper_p">在尚達塑膠有限公司，我們不僅僅是塑膠袋的製造商，我們是您可靠的合作夥伴。我們致力於提供卓越的客戶服務，以滿足您的需求，並確保您的產品在市場上脫穎而出。</p>
                    <p class="upper_p">選擇尚達，您選擇了品質、專業和信任。與我們一起，共同創建更美好的明天。</p>
                    <p class="lower_p">塑膠之美，尚達之品。</p>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

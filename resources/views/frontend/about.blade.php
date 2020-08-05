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
                    <img src="{{  asset('/images/background/welcome.jpg') }}" alt="">
                </div>
                <div class="col-md-6 about-info">
                    <h2>關於我們</h3>
                    <p class="upper_p">
                        自民國XX年（西元XXXX）成立自今，累積了XX年專業製造經驗，加上頂上的生產設備、
                        高品質的進口原料與精益求精的工作態度，製造出價格親民、品質強韌耐用的塑膠袋。

                    </p>
                    <p class="lower_p">信任尚達，天天發達。</p>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

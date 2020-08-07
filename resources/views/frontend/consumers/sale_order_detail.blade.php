@extends('layouts.frontend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/frontend/consumers/show.js') }}" defer></script> --}}
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/sale_order_details.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<section class="sale-order-detail-header">
    <div class="container">
        <h2 class="title">訂單詳細資訊</h2>
    </div>
    <div class="bg-image"></div>
    <div class="bg-gray"></div>
</section>


<section class="sale-order-detail" >
    <div class="container detail-container">
        <div class="sale-order-subtitle text-left">
            <h3><i class="fas fa-calendar-alt"></i>訂單資訊</h3>
        </div>
        <div class="detail-content sale-order-content">
            <div class="row">
                <div class="col-md-6">
                    <p>訂單編號 : {{ $sale_order->shown_id }}</p>
                </div>
                <div class="col-md-6">
                    <p>建立日期 : {{ $sale_order->showCreatedDate() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>付款日期 : {{ $sale_order->showPaidAtDate() }}</p>
                </div>
                <div class="col-md-6">
                    <p>出貨日期 : {{ $sale_order->showDeliverAtDate() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>訂單狀態 : {{ $sale_order->showSaleOrderStatus() }}</p>
                </div>
                <div class="col-md-6">
                    <p>訂單總額 : {{ $sale_order->totalTaxPrice }} 元</p>
                </div>
            </div>
        </div>
        <div class="sale-order-subtitle text-left">
            <h3><i class="fas fa-list-alt"></i>訂單細項</h3>
        </div>
        <div class="detail-content">
            <table class="table detail-table">
                <thead>
                  <tr>
                    <th scope="col">序號</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">數量</th>
                    <th scope="col">單價</th>
                    <th scope="col">折數</th>
                    <th scope="col">小計</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <th scope="row">{{ $detail->index }}</th>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }} {{ $detail->product->showUnit()}}</td>
                        <td>{{ $detail->price }} 元</td>
                        <td>{{ $detail->discount * 100 }} %</td>
                        <td>{{ $detail->subTotal }} 元</td>
                        <td><a href="{{ route('front.products.show' , $detail->product->id) }}"><i class="fas fa-info-circle"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</section>


@endsection

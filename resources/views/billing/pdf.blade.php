<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>尚達塑膠 - 請款單</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sb-font {
            font-family: '標楷體', sans-serif;
        }
    </style>
</head>
<body>
    @if( empty($data['consumer_id']) || empty($data['start_at']) || empty($data['end_at']) )
        {{--  如果資料有誤 --}}
        <span>參數有誤請重新查詢</span>
    @else

        <div class="w-full flex justify-center items-center">

            <div class="lg:w-5/6 md:w-full sm:w-full mb-48 flex flex-col justify-center items-center">

                <div class="w-full text-center mt-12 mb-2">
                    <h1 class="text-4xl font-bold tracking-widest sb-font">尚達塑膠有限公司</h1>
                    <h2 class="text-3xl font-bold tracking-widest sb-font">請款單明細</h2>
                </div>

                <div class="w-full flex flex-col">

                    <div>
                        <span class="font-bold sb-font inline-block w-20">客　　戶：</span>
                        <span>{{ $data['result']->name }}</span>
                    </div>

                    <div>
                        <span class="font-bold sb-font inline-block w-20"><span style="letter-spacing: 0.333rem">聯絡人</span>：</span>
                        @if ( empty($data['result']->operator_name_1) )
                            <span>無資料</span>
                        @else
                            <span>{{ $data['result']->operator_name_1 }}</span>
                            @if ( !empty($data['result']->operator_phone_1) )
                                <span>{{ $data['result']->operator_phone_1 }}</span>
                            @endif
                        @endif
                    </div>

                    <div>
                        <span class="font-bold sb-font inline-block w-20">公司地址：</span>
                        @if ( empty($data['result']->address_county) || empty($data['result']->address_district) || empty($data['result']->address_others) )
                            <span>無資料</span>
                        @else
                            <span>{{ $data['result']->address_county . $data['result']->address_district . $data['result']->address_others }}</span>
                        @endif
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <span class="font-bold sb-font inline-block w-20">日　　期：</span>
                            <span>{{ $data['start_at'] }} ~ {{ $data['end_at'] }}</span>
                        </div>

                        <div>
                            <span class="font-bold sb-font inline-block w-20">列印日期：</span>
                            <span>{{ date("Y/m/d") }}</span>
                        </div>
                    </div>

                </div>

                <div class="w-full mt-2 border-b-4 border-zinc-900"></div>

                <div class="w-full flex flex-col justify-center">
                    <div class="w-full flex flex-row mb-2 font-bold sb-font border-b-4 border-double border-zinc-900 text-center">
                        <div class="flex justify-center py-2 border-x-2" style="width: 10%">日期</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 15%">單號</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 25%">品名規格</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 5%">數量</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 5%">單價</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 5%">折數</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 8%">金額</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 8%">稅額</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 9%">總額</div>
                        <div class="flex justify-center py-2 border-r-2" style="width: 10%">備註</div>
                    </div>

                    @foreach( $data['result']->salesOrders as $salesOrder )
                        <div class="w-full flex flex-col mb-2 pb-1 border-b-4 border-zinc-900">
                            @foreach( $salesOrder->details as $detail )
                                <div class="w-full flex flex-row">
                                    @if ( $loop->first )
                                        <div class="flex justify-start px-1" style="width: 10%">{{ $salesOrder->transaction_at->format('Y/m/d') }}</div>
                                        <div class="flex justify-start px-1" style="width: 15%">{{ $salesOrder->shown_id }}</div>
                                    @else
                                        <div class="flex justify-start" style="width: 25%"></div>
                                    @endif
                                    <div class="flex justify-start px-1" style="width: 25%">{{ $detail->product->name }}</div>
                                    <div class="flex justify-end px-1" style="width: 5%">{{ number_format($detail->quantity, 0) }}</div>
                                    <div class="flex justify-end px-1" style="width: 5%">{{ number_format($detail->price, 2) }}</div>
                                    <div class="flex justify-end px-1" style="width: 5%">{{ number_format($detail->discount, 2) }}</div>
                                    <div class="flex justify-end px-1" style="width: 8%">{{ number_format($detail->totalAmount, 2) }}</div>
                                    <div class="flex justify-end px-1" style="width: 8%">{{ number_format($detail->taxAmount, 2) }}</div>
                                    <div class="flex justify-end px-1" style="width: 9%">{{ number_format($detail->total, 2) }}</div>
                                    <div class="flex justify-start px-1" style="width: 10%">{{ $detail->comment }}</div>
                                </div>
                            @endforeach

                            <div class="w-full flex flex-row my-2">
                                <div style="width: 40%"></div>
                                <div class="border-b-2 border-dashed border-zinc-500" style="width: 50%"></div>
                            </div>

                            <div class="w-full flex flex-row">
                                <div class="flex justify-start" style="width: 40%"></div>
                                <div class="flex justify-start font-bold sb-font" style="width: 10%">小計：</div>
                                <div class="flex justify-start" style="width: 15%"></div>
                                <div class="flex justify-end px-1" style="width: 8%">{{ number_format($salesOrder->orderTotalAmount, 2) }}</div>
                                <div class="flex justify-end px-1" style="width: 8%">{{ number_format($salesOrder->orderTaxAmount, 2) }}</div>
                                <div class="flex justify-end px-1" style="width: 9%">{{ number_format($salesOrder->orderTotal, 2) }}</div>
                                <div class="flex justify-start px-1" style="width: 10%"></div>
                            </div>

                        </div>
                    @endforeach

                    <div class="w-full flex flex-row mb-2">
                        <div class="flex justify-start" style="width: 40%"></div>
                        <div class="flex justify-start font-bold sb-font" style="width: 25%">本期總金額合計：</div>
                        <div class="flex justify-end px-1" style="width: 8%">{{ number_format($data['result']->periodTotalAmount, 2) }}</div>
                        <div class="flex justify-end px-1" style="width: 8%">{{ number_format($data['result']->periodTaxAmount, 2) }}</div>
                        <div class="flex justify-end px-1 font-bold" style="width: 9%">{{ number_format($data['result']->periodTotal, 2) }}</div>
                        <div class="flex justify-start" style="width: 10%"></div>
                    </div>

                </div>




            </div>

        </div>

    @endif
</body>
</html>

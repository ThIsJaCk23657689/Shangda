@extends('layouts.backend.master')

@push('CustomJS')

@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('sales.index') }}">{{ __('Sales Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="consumer_name">
                            <span class="text-danger mr-2">*</span>顧客名稱
                        </label>
                        <input id="consumer_name" name="consumer_name" type="text" class="form-control" value="{{ $salesOrder->consumer->name ?? '無' }}" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="shownID">銷貨單編號</label>
                        <input id="shownID" name="shownID" type="text" value="{{ $salesOrder->shownID ?? '無' }}" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">訂單建立日期</label>
                        <input id="created_at" type="text" class="form-control" value="{{ $salesOrder->created_at ?? '無' }}" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="creator">建立者</label>
                        <input id="creator" type="text" value="{{ $salesOrder->user->name ?? '無' }}" class="form-control" readonly>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_shortName">顧客簡稱</label>
                                <input id="show_shortName" type="text" class="form-control" value="{{ $salesOrder->consumer->shortName ?? '無' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_act">帳號</label>
                                <input id="show_act" type="text" class="form-control" value="{{ $salesOrder->consumer->account ?? '無' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_taxID">統一編號</label>
                                <input id="show_taxID" type="text" class="form-control" value="{{ $salesOrder->consumer->taxID ?? '無' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_settlement">結算方式</label>
                                <input id="show_settlement" type="text" class="form-control mb-2" value="{{ $salesOrder->consumer->monthlyCheckDate == 0 ? '日結' : '月結' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_uncheckedAmount">未沖帳金額</label>
                                <input id="show_uncheckedAmount" type="text" class="form-control" value="{{ $salesOrder->consumer->uncheckedAmount ?? 0 }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="show_totalConsumption">總消費額</label>
                                <input id="show_totalConsumption" type="text" class="form-control" value="{{ $salesOrder->consumer->totalConsumption ?? 0 }}" readonly>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="show_consumer_comment">顧客備註</label>
                        <textarea id="show_consumer_comment" type="text" class="form-control" readonly style="height: 100%">{{ $salesOrder->consumer->comment ?? '無' }}</textarea>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="show_companyAddress">公司地址</label>
                        <input id="show_companyAddress" type="text" class="form-control" value="{{ $salesOrder->consumer->showAddress() ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="show_deliveryAddress">送貨地址</label>
                        <input id="show_deliveryAddress" type="text" class="form-control" value="{{ $salesOrder->consumer->showDeliveryAddress() ?? '無' }}" readonly>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectPay_at">
                                    <span class="text-danger mr-2">*</span>預計付款日
                                </label>
                                <input id="expectPay_at" name="expectPay_at" type="text" value="{{ $salesOrder->expectPay_at ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectDeliver_at">
                                    <span class="text-danger mr-2">*</span>預計出貨日
                                </label>
                                <input id="expectDeliver_at" name="expectDeliver_at" type="text" value="{{ $salesOrder->expectDeliver_at ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectPay_at">
                                    <span class="text-danger mr-2">*</span>實際付款日
                                </label>
                                <input id="expectPay_at" name="expectPay_at" type="text" value="{{ $salesOrder->paid_at ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expectDeliver_at">
                                    <span class="text-danger mr-2">*</span>實際出貨日
                                </label>
                                <input id="expectDeliver_at" name="expectDeliver_at" type="text" value="{{ $salesOrder->delivered_at ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="invoiceType">
                                    <span class="text-danger mr-2">*</span>發票類型
                                </label>
                                <input id="taxType" name="taxType" type="text" value="{{ $salesOrder->showInvoiceType() ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="taxType">
                                    <span class="text-danger mr-2">*</span>稅別
                                </label>
                                <input id="taxType" name="taxType" type="text" value="{{ $salesOrder->showTaxType() ?? '無' }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="height: 72%">
                        <label for="comment">訂單備註</label>
                        <textarea id="comment" name="comment" type="text" class="form-control" style="height: 100%" readonly>{{ $salesOrder->showAddress ?? '無' }}</textarea>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>商品</th>
                                <th>國際條碼</th>
                                <th>數量</th>
                                <th>單價</th>
                                <th>折數</th>
                                <th>小計</th>
                                <th>備註</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesOrder->details as $detail)
                                <tr>
                                    <td style="width: 5%">{{ $loop->iteration }}</td>
                                    <td style="width: 20%">
                                        {{ $detail->product->name }}
                                    </td>
                                    <td style="width: 10%">
                                        {{ $detail->product->internationalNum }}
                                    </td>
                                    <td style="width: 15%">
                                        {{ $detail->quantity }}
                                        {{ $detail->product->showUnit() }}
                                    </td>
                                    <td style="width: 10%">
                                        {{ $detail->price }}
                                    </td>
                                    <td style="width: 10%">
                                        {{ $detail->discount }}
                                    </td>
                                    <td style="width: 10%">
                                        {{ $detail->subTotal }}
                                    </td>
                                    <td style="width: 20%">
                                        {{ $detail->comment }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalPrice">銷售額</label>
                        <input id="totalPrice" type="text" class="form-control" value="{{ $salesOrder->showBeforePrice() ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxPrice">稅額</label>
                        <input id="taxPrice" type="text" class="form-control" value="{{ $salesOrder->showTaxPrice() ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalTaxPrice">總額</label>
                        <input id="totalTaxPrice" name="totalTaxPrice" type="text" class="form-control" value="{{ $salesOrder->totalPrice ?? '無' }}" readonly>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('sales.index') }}" class="btn btn-block btn-danger">
                        返回首頁
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

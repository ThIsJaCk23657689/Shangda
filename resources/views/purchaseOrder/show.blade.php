@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/purchase.js') }}" defer></script>
@endpush   

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Purchase Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
    @endcomponent

	<div id="purchase">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="#">
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="supplier_id" class="col-md-3 col-form-label text-md-right">
                                    <span class="text-danger">*</span>
                                    供應商
                                </label>
        
                                <div class="col-md-6 mb-2">
                                    <input type="text" class="form-control" id="supplier_id" value="{{ $purchaseOrder->supplier->name }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="showShortName" class="col-md-3 col-form-label text-md-right">供應商簡稱</label>
        
                                <div class="col-md-6">
                                    <input id="showShortName" type="text" class="form-control" value="{{ $purchaseOrder->supplier->shortName }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="showTaxId" class="col-md-3 col-form-label text-md-right">統一編號</label>
        
                                <div class="col-md-6">
                                    <input id="showTaxId" type="text" class="form-control" value="{{ $purchaseOrder->supplier->taxId }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="showTel" class="col-md-3 col-form-label text-md-right">電話</label>
        
                                <div class="col-md-6">
                                    <input id="showTel" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tel }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="showTax" class="col-md-3 col-form-label text-md-right">傳真</label>
        
                                <div class="col-md-6">
                                    <input id="showTax" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tax }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <hr>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="showInCharge1" class="col-md-3 col-form-label text-md-right">
                                    負責人1 - 名稱
                                </label>
        
                                <div class="col-md-6">
                                    <input id="showInCharge1" type="text" class="form-control" value="{{ $purchaseOrder->supplier->inCharge1 }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="showTel1" class="col-md-3 col-form-label text-md-right">
                                    負責人1 - 電話
                                </label>
        
                                <div class="col-md-6">
                                    <input id="showTel1" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tel1 }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="showCompanyAddress" class="col-md-3 col-form-label text-md-right">
                                    公司地址
                                </label>
        
                                <div class="col-md-9">
                                    <input id="showCompanyAddress" type="text" class="form-control" value="{{ $purchaseOrder->supplier->companyAddress }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <hr>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="expectReceived_at" class="col-md-3 col-form-label text-md-right">
                                    預期到貨時間
                                </label>
        
                                <div class="col-md-6">
                                    <input id="expectReceived_at" type="date" class="form-control" value="{{ $purchaseOrder->expectReceived_at }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="PurchaseComment" class="col-md-3 col-form-label text-md-right">
                                    備註
                                </label>
        
                                <div class="col-md-6">
                                    <input id="PurchaseComment" type="text" class="form-control" value="{{ $purchaseOrder->comment }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="taxType" class="col-md-3 col-form-label text-md-right">
                                    稅別
                                </label>
        
                                <div class="col-md-6">
                                    <input id="taxType" type="text" class="form-control" value="{{ $purchaseOrder->showTaxType() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="invoiceType" class="col-md-3 col-form-label text-md-right">
                                    發票類型
                                </label>
        
                                <div class="col-md-6">
                                    <input id="invoiceType" type="text" class="form-control" value="{{ $purchaseOrder->showInvoiceType() }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <hr>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form method="POST" action="#">
                    
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>原物料</th>
                                            <th>國際條碼</th>
                                            <th>數量</th>
                                            <th>單價</th>
                                            <th>折數</th>
                                            <th>小計</th>
                                            <th>備註</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseOrder->details as $detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $detail->material->name }}
                                                </td>
                                                <td>
                                                    {{ $detail->material->internationalNum }}
                                                </td>
                                                <td>
                                                    {{ $detail->quantity }}
                                                    {{ $detail->material->showUnit() }}
                                                </td>
                                                <td>
                                                    {{ $detail->price }}
                                                </td>
                                                <td>
                                                    {{ $detail->discount }}
                                                </td>
                                                <td>
                                                    {{ $detail->subTotal }}
                                                </td>
                                                <td>
                                                    {{ $detail->comment }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    
                            </form>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="beforePrice" class="col-md-3 col-form-label text-md-right">銷售額</label>
        
                                <div class="col-md-6">
                                    <input id="beforePrice" type="text" class="form-control" value="{{ $purchaseOrder->showBeforePrice() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="tax_price" class="col-md-2 col-form-label text-md-right">稅額</label>
        
                                <div class="col-md-6">
                                    <input id="tax_price" type="text" class="form-control" value="{{ $purchaseOrder->showTaxPrice() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="totalPrice" class="col-md-2 col-form-label text-md-right">總額</label>
        
                                <div class="col-md-6">
                                    <input id="totalPrice" type="text" class="form-control" value="{{ $purchaseOrder->totalPrice }}" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
        
                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-block btn-primary">
                                確認新增
                            </button>
                            <a href="#" class="btn btn-block btn-danger">
                                返回上一頁
                            </a>
                        </div>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
	
@endsection

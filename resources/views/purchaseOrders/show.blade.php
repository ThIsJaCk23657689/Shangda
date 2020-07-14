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
                                <input id="showShortName" type="text" class="form-control" value="{{ $purchaseOrder->supplier->shortName ?? '無' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="showTaxId" class="col-md-3 col-form-label text-md-right">統一編號</label>
    
                            <div class="col-md-6">
                                <input id="showTaxId" type="text" class="form-control" value="{{ $purchaseOrder->supplier->taxId ?? '無' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="showTel" class="col-md-3 col-form-label text-md-right">電話</label>
    
                            <div class="col-md-6">
                                <input id="showTel" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tel ?? '無' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="showTax" class="col-md-3 col-form-label text-md-right">傳真</label>
    
                            <div class="col-md-6">
                                <input id="showTax" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tax ?? '無' }}" disabled>
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
                                <input id="showInCharge1" type="text" class="form-control" value="{{ $purchaseOrder->supplier->inCharge1 ?? '無' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="showTel1" class="col-md-3 col-form-label text-md-right">
                                負責人1 - 電話
                            </label>
    
                            <div class="col-md-6">
                                <input id="showTel1" type="text" class="form-control" value="{{ $purchaseOrder->supplier->tel1 ?? '無' }}" disabled>
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
                                <input id="showCompanyAddress" type="text" class="form-control" value="{{ $purchaseOrder->supplier->companyAddress ?? '無' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
    
                <hr>

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="expectReceived_at">預期到貨時間</label>
                                    <input id="expectReceived_at" type="text" class="form-control" value="{{ $purchaseOrder->showExpectReceivedAtDate() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="received_at">預期到貨時間</label>
                                    <input id="received_at" type="text" class="form-control" value="{{ $purchaseOrder->showReceivedAtDate() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="received_status">到貨狀態</label>
                                    <input id="received_status" type="text" class="form-control" value="{{ $purchaseOrder->showReceivedStatus() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paid_at">付款時間</label>
                                    <input id="paid_at" type="text" class="form-control" value="{{ $purchaseOrder->showPaidAtDate() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="received_status">付款狀態</label>
                                    <input id="received_status" type="text" class="form-control" value="{{ $purchaseOrder->showPaidStatus() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taxType">稅別</label>
                                    <input id="taxType" type="text" class="form-control" value="{{ $purchaseOrder->showTaxType() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoiceType">發票類型</label>
                                    <input id="invoiceType" type="text" class="form-control" value="{{ $purchaseOrder->showInvoiceType() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="PurchaseComment">備註</label>
                                    <textarea id="PurchaseComment" class="form-control" rows="2" disabled>{{ $purchaseOrder->comment ?? '無' }}</textarea>
                                </div>
                            </div>
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
                                        <td style="width: 5%">{{ $loop->iteration }}</td>
                                        <td style="width: 20%">
                                            {{ $detail->material->name }}
                                        </td>
                                        <td style="width: 10%">
                                            {{ $detail->material->internationalNum }}
                                        </td>
                                        <td style="width: 15%">
                                            {{ $detail->quantity }}
                                            {{ $detail->material->showUnit() }}
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

                <hr>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user_id">創建者</label>
                            <input id="user_id" type="text" class="form-control" value="{{ $purchaseOrder->user->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="last_user_id">最後修改者</label>
                            <input id="last_user_id" type="text" class="form-control" value="{{ $purchaseOrder->showLastUpdater() }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="created_at">建立日期</label>
                            <input id="created_at" type="text" class="form-control" value="{{ $purchaseOrder->created_at }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="updated_at">最後更新日期</label>
                            <input id="updated_at" type="text" class="form-control" value="{{ $purchaseOrder->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <a href="{{ route('purchase.index') }}" class="btn btn-block btn-danger">
                            返回首頁
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
@endsection

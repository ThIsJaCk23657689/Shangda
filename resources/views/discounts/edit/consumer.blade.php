@extends('layouts.backend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script> --}}
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/discounts/edit-consumer.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('discounts.index') }}">{{ __('Discounts') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent
    
    <div id="discounts">
		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
        <span id="getProductInfo" style="display: none;">{{ route('products.getInfo') }}</span>
        <span id="getDiscountsList" style="display: none;">{{ route('consumers.getDiscountsList', [$consumer->id]) }}</span>
        <span id="discountsIndex" style="display: none;">{{ route('discounts.index') }}</span>

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="row">
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shownID">顧客編號</label>
                            <input id="shownID" type="text" class="form-control mb-2" value="{{ $consumer->shownID }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">顧客名稱</label>
                            <input id="name" type="text" class="form-control mb-2" value="{{ $consumer->name }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="act">帳號</label>
                            <input id="act" type="text" class="form-control" value="{{ $consumer->act }}" readonly>
                        </div>
                    </div>
    
                </div>
    
                <div class="row">
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="taxID">統一編號</label>
                            <input id="taxID" type="text" class="form-control mb-2" value="{{ $consumer->taxID }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idNumber">身分證</label>
                            <input id="idNumber" type="text" class="form-control mb-2" value="{{ $consumer->idNumber }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax">傳真</label>
                            <input id="tax" type="text" class="form-control" value="{{ $consumer->tax }}" readonly>
                        </div>
                    </div>
    
                </div>
    
                <div class="row">
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inCharge1">負責人1 - 姓名</label>
                            <input id="inCharge1" type="text" class="form-control mb-2" value="{{ $consumer->inCharge1 }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel1">負責人1 - 電話</label>
                            <input id="tel1" type="text" class="form-control mb-2" value="{{ $consumer->tel1 }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email1">負責人1 - 信箱</label>
                            <input id="email1" type="text" class="form-control" value="{{ $consumer->email1 }}" readonly>
                        </div>
                    </div>
    
                </div>
    
                <div class="row">
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inCharge2">負責人2 - 姓名</label>
                            <input id="inCharge2" type="text" class="form-control mb-2" value="{{ $consumer->inCharge2 }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel2">負責人2 - 電話</label>
                            <input id="tel2" type="text" class="form-control mb-2" value="{{ $consumer->tel2 }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email2">負責人2 - 信箱</label>
                            <input id="email2" type="text" class="form-control" value="{{ $consumer->email2 }}" readonly>
                        </div>
                    </div>
    
                </div>
    
                <div class="row">
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monthlyCheckDate">月結日</label>
                            <input id="monthlyCheckDate" type="text" class="form-control mb-2" value="{{ $consumer->monthlyCheckDate }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="uncheckedAmount">未沖帳金額</label>
                            <input id="uncheckedAmount" type="text" class="form-control mb-2" value="{{ $consumer->uncheckedAmount }}" readonly>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="totalConsumption">總消費額</label>
                            <input id="totalConsumption" type="text" class="form-control" value="{{ $consumer->totalConsumption }}" readonly>
                        </div>
                    </div>
    
                </div>
    
            </div>
        </div>

        <consumer-discounts :products="products" :discounts="discounts" v-on:refresh-products="refreshProducts"></consumer-discounts>
	</div>

@endsection

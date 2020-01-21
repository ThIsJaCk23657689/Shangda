@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/consumers/create.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('consumers.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                名稱
                            </label>
        
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="shortName" class="col-md-3 col-form-label text-md-right">
                                簡稱
                            </label>
        
                            <div class="col-md-6">
                                <input id="shortName" name="shortName" type="text" class="form-control @error('shortName') is-invalid @enderror" value="{{ old('shortName') }}" autocomplete="shortName">
        
                                @error('shortName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="act" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                帳號
                            </label>
        
                            <div class="col-md-6">
                                <input id="act" name="act" type="text" class="form-control @error('act') is-invalid @enderror"  value="{{ old('act') }}" required autocomplete="act">
        
                                @error('act')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="taxID" class="col-md-3 col-form-label text-md-right">
                                統一編號
                            </label>
        
                            <div class="col-md-6">
                                <input id="taxID" name="taxID" type="text" class="form-control @error('taxID') is-invalid @enderror"  value="{{ old('taxID') }}" autocomplete="taxID">
        
                                @error('taxID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="pwd" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                密碼
                            </label>
        
                            <div class="col-md-6">
                                <input id="pwd" name="pwd" type="password" class="form-control @error('pwd') is-invalid @enderror" value="{{ old('pwd') }}" required autocomplete="pwd">
        
                                @error('pwd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="idNumber" class="col-md-3 col-form-label text-md-right">
                                身分證
                            </label>
        
                            <div class="col-md-6">
                                <input id="idNumber" name="idNumber" type="text" class="form-control @error('idNumber') is-invalid @enderror" value="{{ old('idNumber') }}" autocomplete="idNumber">
        
                                @error('idNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="pwd_confirmation" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                確認密碼
                            </label>
        
                            <div class="col-md-6">
                                <input id="pwd_confirmation" name="pwd_confirmation" type="password" class="form-control @error('pwd_confirmation') is-invalid @enderror" value="{{ old('pwd_confirmation') }}" required autocomplete="pwd_confirmation">
        
                                @error('pwd_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tax" class="col-md-3 col-form-label text-md-right">
                                傳真
                            </label>
        
                            <div class="col-md-6">
                                <input id="tax" name="tax" type="text" class="form-control @error('tax') is-invalid @enderror" value="{{ old('tax') }}" autocomplete="tax">
        
                                @error('tax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inCharge1" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                聯絡人1 - 名稱
                            </label>
        
                            <div class="col-md-6">
                                <input id="inCharge1" name="inCharge1" type="text" class="form-control @error('inCharge1') is-invalid @enderror" value="{{ old('inCharge1') }}" required autocomplete="inCharge1">
        
                                @error('inCharge1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inCharge2" class="col-md-3 col-form-label text-md-right">
                                聯絡人2 - 名稱
                            </label>
        
                            <div class="col-md-6">
                                <input id="inCharge2" name="inCharge2" type="text" class="form-control @error('inCharge2') is-invalid @enderror" value="{{ old('inCharge2') }}" autocomplete="inCharge2">
        
                                @error('inCharge2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tel1" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                聯絡人1 - 電話
                            </label>
        
                            <div class="col-md-6">
                                <input id="tel1" name="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" value="{{ old('tel1') }}" required autocomplete="tel1">
        
                                @error('tel1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tel2" class="col-md-3 col-form-label text-md-right">
                                聯絡人2 - 電話
                            </label>
        
                            <div class="col-md-6">
                                <input id="tel2" name="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" value="{{ old('tel2') }}" autocomplete="tel2">
        
                                @error('tel2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="email1" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                聯絡人1 - 信箱
                            </label>
        
                            <div class="col-md-6">
                                <input id="email1" name="email1" type="email" class="form-control @error('email1') is-invalid @enderror" value="{{ old('email1') }}" required autocomplete="email1">
        
                                @error('email1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="email2" class="col-md-3 col-form-label text-md-right">
                                聯絡人2 - 信箱
                            </label>
        
                            <div class="col-md-6">
                                <input id="email2" name="email2" type="email" class="form-control @error('email2') is-invalid @enderror" value="{{ old('email2') }}" autocomplete="email2">
        
                                @error('email2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="monthlyCheckDate" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                月結日
                            </label>
        
                            <div class="col-md-4">
                                <select  id="monthlyCheckDate" name="monthlyCheckDate" class="form-control @error('monthlyCheckDate') is-invalid @enderror" required>
                                    <option value="0">請選擇...</option>
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('monthlyCheckDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <input id="monthlyCheck" name="monthlyCheck" type="checkbox" value="true" autocomplete="monthlyCheckDate">
                                <label for="monthlyCheck" class="col-form-label">
                                    日結
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="uncheckedAmount" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                未沖帳金額
                            </label>
        
                            <div class="col-md-6">
                                <input id="uncheckedAmount" name="uncheckedAmount" type="text" class="form-control @error('uncheckedAmount') is-invalid @enderror" value="{{ old('uncheckedAmount') ?? 0 }}" required autocomplete="uncheckedAmount">
        
                                @error('uncheckedAmount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="totalConsumption" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                總消費額
                            </label>
        
                            <div class="col-md-6">
                                <input id="totalConsumption" name="totalConsumption" type="text" class="form-control @error('totalConsumption') is-invalid @enderror" value="{{ old('totalConsumption') ?? 0 }}" required autocomplete="totalConsumption">
        
                                @error('totalConsumption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="comment" class="col-md-3 col-form-label text-md-right">
                                備註
                            </label>
        
                            <div class="col-md-6">
                                <input id="comment" name="comment" type="text" class="form-control @error('comment') is-invalid @enderror" value="{{ old('comment') }}" autocomplete="comment">
        
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="companyAddress" class="col-md-3 col-form-label text-md-right">
                                <span class="text-danger">*</span>
                                公司地址
                            </label>
        
                            <div class="col-md-9">
                                <input id="companyAddress" type="text" class="form-control @error('companyAddress') is-invalid @enderror" name="companyAddress" value="{{ old('companyAddress') }}" autocomplete="companyAddress" required>
        
                                @error('companyAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="deliveryAddress" class="col-md-3 col-form-label text-md-right">
                                送貨地址
                            </label>
        
                            <div class="col-md-6">
                                <input id="deliveryAddress" type="text" class="form-control @error('deliveryAddress') is-invalid @enderror" name="deliveryAddress" value="{{ old('deliveryAddress') }}" autocomplete="deliveryAddress">
                                
                                @error('deliveryAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="checkbox" id="copycompany1">
                                <label class="col-form-label" for="copycompany1">同公司地址</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="invoiceAddress" class="col-md-3 col-form-label text-md-right">
                                發票地址
                            </label>
        
                            <div class="col-md-6">
                                <input id="invoiceAddress" type="text" class="form-control @error('invoiceAddress') is-invalid @enderror" name="invoiceAddress" value="{{ old('invoiceAddress') }}" autocomplete="invoiceAddress">
        
                                @error('invoiceAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="checkbox" id="copycompany2">
                                <label class="col-form-label" for="copycompany2">同公司地址</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認新增
                        </button>
                        <a href="{{ route('consumers.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
	
@endsection

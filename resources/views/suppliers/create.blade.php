@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/suppliers/create.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h4>1. 供應商基本資訊</h4>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">
                                <span class="text-danger mr-2">*</span>供應商名稱
                            </label>
                            <input id="name" name="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="off" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shortName">供應商簡稱</label>

                            <input id="shortName" name="shortName" type="text" class="form-control mb-2 @error('shortName') is-invalid @enderror" value="{{ old('shortName') }}" autocomplete="off">

                            @error('shortName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="taxId">統一編號</label>
                            <input id="taxId" name="taxId" type="text" class="form-control @error('taxId') is-invalid @enderror" value="{{ old('taxId') }}" autocomplete="taxId">
                            @error('taxId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">電話</label>
                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" autocomplete="tel">
                                    @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax">傳真</label>
                                    <input id="tax" type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value="{{ old('tax') }}" autocomplete="tax">
                                    @error('tax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="companyAddress_twzipcode" class="form-group">
                                    <label><span class="text-danger mr-2">*</span>公司地址</label>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <div data-role="county" data-style="form-control" data-name="companyAddress_county" data-value="{{ old('companyAddress_county') ?? '' }}"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="district" data-style="form-control" data-name="companyAddress_district" data-value="{{ old('companyAddress_district') ?? '' }}"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="zipcode" data-style="form-control" data-name="companyAddress_zipcode" data-value="{{ old('companyAddress_zipcode') ?? '' }}"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="companyAddress_others" type="text" class="form-control @error('companyAddress_others') is-invalid @enderror" name="companyAddress_others" value="{{ old('companyAddress_others') }}" autocomplete="off" required>
                                            @error('companyAddress_others')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment">備註</label>
                                    <textarea id="comment" name="comment" type="text" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h4>2. 窗口聯絡資訊</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_name_1"><span class="text-danger mr-2">*</span>聯絡窗口1 - 名稱</label>
                            <input id="operator_name_1" type="text" class="form-control @error('operator_name_1') is-invalid @enderror" name="operator_name_1" value="{{ old('operator_name_1') }}" autocomplete="operator_name_1" required>
                            @error('operator_name_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_tel_1"><span class="text-danger mr-2">*</span>聯絡窗口1 - 電話</label>
                            <input id="operator_tel_1" type="text" class="form-control @error('operator_tel_1') is-invalid @enderror" name="operator_tel_1" value="{{ old('operator_tel_1') }}" autocomplete="operator_tel_1" required>
                            @error('operator_tel_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_email_1">聯絡窗口1 - 信箱</label>
                            <input id="operator_email_1" type="email" class="form-control @error('operator_email_1') is-invalid @enderror" name="operator_email_1" value="{{ old('operator_email_1') }}" autocomplete="operator_email_1">
                            @error('operator_email_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_name_2">聯絡窗口2 - 名稱</label>
                            <input id="operator_name_2" type="text" class="form-control @error('operator_name_2') is-invalid @enderror" name="operator_name_2" value="{{ old('operator_name_2') }}" autocomplete="operator_name_2">
                            @error('operator_name_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_tel_2">聯絡窗口2 - 電話</label>
                            <input id="operator_tel_2" type="text" class="form-control @error('operator_tel_2') is-invalid @enderror" name="operator_tel_2" value="{{ old('operator_tel_2') }}" autocomplete="operator_tel_2">
                            @error('operator_tel_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="operator_email_2">聯絡窗口2 - 信箱</label>
                            <input id="operator_email_2" type="email" class="form-control @error('operator_email_2') is-invalid @enderror" name="operator_email_2" value="{{ old('operator_email_2') }}" autocomplete="operator_email_2">
                            @error('operator_email_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h4>3. 付款資訊</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_name">銀行名稱</label>
                            <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ old('bank_name') }}" autocomplete="bank_name">
                            @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_branch_name">分行名稱</label>
                            <input id="bank_branch_name" type="text" class="form-control @error('bank_branch_name') is-invalid @enderror" name="bank_branch_name" value="{{ old('bank_branch_name') }}" autocomplete="bank_branch_name">
                            @error('bank_branch_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_code">銀行通匯代號</label>
                            <input id="bank_code" type="text" class="form-control @error('bank_code') is-invalid @enderror" name="bank_code" value="{{ old('bank_code') }}" autocomplete="bank_code">
                            <small class="form-text text-muted">銀行代號+分行代號</small>
                            @error('bank_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bank_account">帳號</label>
                            <input id="bank_account" type="text" class="form-control @error('bank_account') is-invalid @enderror" name="bank_account" value="{{ old('bank_account') }}" autocomplete="bank_account">
                            @error('bank_account')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank_account_name">戶名</label>
                            <input id="bank_account_name" type="text" class="form-control @error('bank_account_name') is-invalid @enderror" name="bank_account_name" value="{{ old('bank_account_name') }}" autocomplete="bank_account_name">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="isSameAsName" id="isSameAsName" value="1">
                                <label class="custom-control-label" for="isSameAsName">
                                    <small>與供應商名稱相同</small>
                                </label>
                            </div>
                            @error('bank_account_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_method">付款方式</label>
                            <select id="payment_method" name="payment_method" class="form-control mb-2 @error('payment_method') is-invalid @enderror">
                                <option value="0">請選擇...</option>
                                <option value="1" {{ old('companyAddress_zipcode') == '0' ? 'selected' : '' }}>現金支付</option>
                                <option value="2" {{ old('companyAddress_zipcode') == '1' ? 'selected' : '' }}>銀行匯款</option>
                                <option value="3" {{ old('companyAddress_zipcode') == '2' ? 'selected' : '' }}>支票</option>
                                <option value="4" {{ old('companyAddress_zipcode') == '3' ? 'selected' : '' }}>信用卡</option>
                            </select>
                            @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monthlyCheckDate">
                                <span class="text-danger mr-2">*</span>月結日
                            </label>
                            <select id="monthlyCheckDate" name="monthlyCheckDate" class="form-control mb-2 @error('monthlyCheckDate') is-invalid @enderror" disabled>
                                <option value="0">請選擇...</option>
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ ( old('monthlyCheckDate') == $i )? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="monthlyCheck" id="monthlyCheck" value="1" checked>
                                <label class="custom-control-label" for="monthlyCheck">
                                    <small>貨到付款</small>
                                </label>
                            </div>
                            @error('monthlyCheckDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認新增
                        </button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
	
@endsection

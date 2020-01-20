@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        供應商名稱
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $supplier->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shortName" class="col-md-4 col-form-label text-md-right">供應商簡稱</label>

                    <div class="col-md-6">
                        <input id="shortName" type="text" class="form-control @error('shortName') is-invalid @enderror" name="shortName" value="{{ $supplier->shortName }}" autocomplete="shortName">

                        @error('shortName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="taxId" class="col-md-4 col-form-label text-md-right">統一編號</label>

                    <div class="col-md-6">
                        <input id="taxId" type="text" class="form-control @error('taxId') is-invalid @enderror" name="taxId" value="{{ $supplier->taxId }}" autocomplete="taxId">

                        @error('taxId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel" class="col-md-4 col-form-label text-md-right">電話</label>

                    <div class="col-md-6">
                        <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ $supplier->tel }}" autocomplete="tel">

                        @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tax" class="col-md-4 col-form-label text-md-right">傳真</label>

                    <div class="col-md-6">
                        <input id="tax" type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value="{{ $supplier->tax }}" autocomplete="tax">

                        @error('tax')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="inCharge1" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        負責人1 - 名稱
                    </label>

                    <div class="col-md-6">
                        <input id="inCharge1" type="text" class="form-control @error('inCharge1') is-invalid @enderror" name="inCharge1" value="{{ $supplier->inCharge1 }}" autocomplete="inCharge1">

                        @error('inCharge1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel1" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        負責人1 - 電話
                    </label>

                    <div class="col-md-6">
                        <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ $supplier->tel1 }}" autocomplete="tel1">

                        @error('tel1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email1" class="col-md-4 col-form-label text-md-right">負責人1 - 信箱</label>

                    <div class="col-md-6">
                        <input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ $supplier->email1 }}" autocomplete="email1">

                        @error('email1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="inCharge2" class="col-md-4 col-form-label text-md-right">負責人2 - 名稱</label>

                    <div class="col-md-6">
                        <input id="inCharge2" type="text" class="form-control @error('inCharge2') is-invalid @enderror" name="inCharge2" value="{{ $supplier->inCharge2 }}" autocomplete="inCharge2">

                        @error('inCharge2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel2" class="col-md-4 col-form-label text-md-right">負責人2 - 電話</label>

                    <div class="col-md-6">
                        <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2" value="{{ $supplier->tel2 }}" autocomplete="tel2">

                        @error('tel2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email2" class="col-md-4 col-form-label text-md-right">負責人2 - 信箱</label>

                    <div class="col-md-6">
                        <input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ $supplier->email2 }}" autocomplete="email2">

                        @error('email2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="companyAddress" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        公司地址
                    </label>

                    <div class="col-md-6">
                        <input id="companyAddress" type="text" class="form-control @error('companyAddress') is-invalid @enderror" name="companyAddress" value="{{ $supplier->companyAddress }}" autocomplete="companyAddress" required>

                        @error('companyAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="deliveryAddress" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        送貨地址
                    </label>

                    <div class="col-md-6">
                        <input id="deliveryAddress" type="text" class="form-control @error('deliveryAddress') is-invalid @enderror" name="deliveryAddress" value="{{ $supplier->deliveryAddress }}" autocomplete="deliveryAddress" required>

                        @error('deliveryAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="invoiceAddress" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        發票地址
                    </label>

                    <div class="col-md-6">
                        <input id="invoiceAddress" type="text" class="form-control @error('invoiceAddress') is-invalid @enderror" name="invoiceAddress" value="{{ $supplier->invoiceAddress }}" required autocomplete="invoiceAddress">

                        @error('invoiceAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comment" class="col-md-4 col-form-label text-md-right">備註</label>

                    <div class="col-md-6">
                        <input id="comment" type="email" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ $supplier->comment }}" autocomplete="comment">

                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認修改
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

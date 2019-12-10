@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    供應商名稱
                </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $supplier->name }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="shortName" class="col-md-4 col-form-label text-md-right">
                    供應商簡稱
                </label>

                <div class="col-md-6">
                    <input id="shortName" type="text" class="form-control" name="shortName" value="{{ $supplier->shortName }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="taxId" class="col-md-4 col-form-label text-md-right">
                    統一編號
                </label>

                <div class="col-md-6">
                    <input id="taxId" type="text" class="form-control" name="taxId" value="{{ $supplier->taxId }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tel" class="col-md-4 col-form-label text-md-right">電話</label>

                <div class="col-md-6">
                    <input id="tel" type="text" class="form-control" name="tel" value="{{ $supplier->tel }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tax" class="col-md-4 col-form-label text-md-right">傳真</label>

                <div class="col-md-6">
                    <input id="tax" type="text" class="form-control" name="tax" value="{{ $supplier->tax }}" disabled>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="inCharge1" class="col-md-4 col-form-label text-md-right">
                    負責人1 - 名稱
                </label>

                <div class="col-md-6">
                    <input id="inCharge1" type="text" class="form-control" name="inCharge1" value="{{ $supplier->inCharge1 }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tel1" class="col-md-4 col-form-label text-md-right">
                    負責人1 - 電話
                </label>

                <div class="col-md-6">
                    <input id="tel1" type="text" class="form-control" name="tel1" value="{{ $supplier->tel1 }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="email1" class="col-md-4 col-form-label text-md-right">負責人1 - 信箱</label>

                <div class="col-md-6">
                    <input id="email1" type="email" class="form-control" name="email1" value="{{ $supplier->email1 }}" disabled>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="inCharge2" class="col-md-4 col-form-label text-md-right">負責人2 - 名稱</label>

                <div class="col-md-6">
                    <input id="inCharge2" type="text" class="form-control" name="inCharge2" value="{{ $supplier->inCharge2 }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="tel2" class="col-md-4 col-form-label text-md-right">負責人2 - 電話</label>

                <div class="col-md-6">
                    <input id="tel2" type="text" class="form-control" name="tel2" value="{{ $supplier->tel2 }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="email2" class="col-md-4 col-form-label text-md-right">負責人2 - 信箱</label>

                <div class="col-md-6">
                    <input id="email2" type="email" class="form-control" name="email2" value="{{ $supplier->email2 }}" disabled>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="companyAddress" class="col-md-4 col-form-label text-md-right">
                    公司地址
                </label>

                <div class="col-md-6">
                    <input id="companyAddress" type="text" class="form-control" name="companyAddress" value="{{ $supplier->companyAddress }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="deliveryAddress" class="col-md-4 col-form-label text-md-right">
                    送貨地址
                </label>

                <div class="col-md-6">
                    <input id="deliveryAddress" type="text" class="form-control" name="deliveryAddress" value="{{ $supplier->deliveryAddress }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="invoiceAddress" class="col-md-4 col-form-label text-md-right">
                    發票地址
                </label>

                <div class="col-md-6">
                    <input id="invoiceAddress" type="text" class="form-control" name="invoiceAddress" value="{{ $supplier->invoiceAddress }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="comment" class="col-md-4 col-form-label text-md-right">備註</label>

                <div class="col-md-6">
                    <input id="comment" type="email" class="form-control" name="comment" value="{{ $supplier->comment }}" disabled>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>

        </div>
    </div>
	
@endsection

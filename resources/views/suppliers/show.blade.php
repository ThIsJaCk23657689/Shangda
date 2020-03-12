@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">供應商名稱</label>
                        <input id="name" name="name" type="text" class="form-control mb-2" value="{{ $supplier->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shortName">供應商簡稱</label>
                        <input id="shortName" name="shortName" type="text" class="form-control mb-2" value="{{ $supplier->shortName }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxId">統一編號</label>
                        <input id="taxId" name="taxId" type="text" class="form-control" value="{{ $supplier->taxId }}" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tel">電話</label>
                        <input id="tel" type="text" class="form-control" name="tel" value="{{ $supplier->tel }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tax">傳真</label>
                        <input id="tax" type="text" class="form-control" name="tax" value="{{ $supplier->tax }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>公司地址</label>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <input id="CompanyAddress_county" type="text" class="form-control" name="CompanyAddress_county" value="{{ $supplier->CompanyAddress_county }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <input id="CompanyAddress_district" type="text" class="form-control" name="CompanyAddress_district" value="{{ $supplier->CompanyAddress_district }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <input id="CompanyAddress_zipcode" type="text" class="form-control" name="CompanyAddress_zipcode" value="{{ $supplier->CompanyAddress_zipcode }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="CompanyAddress_others" type="text" class="form-control" name="CompanyAddress_others" value="{{ $supplier->CompanyAddress_others }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inCharge1">負責人1 - 名稱</label>
                        <input id="inCharge1" type="text" class="form-control" name="inCharge1" value="{{ $supplier->inCharge1 }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tel1">負責人1 - 電話</label>
                        <input id="tel1" type="text" class="form-control" name="tel1" value="{{ $supplier->tel1 }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email1">負責人1 - 信箱</label>
                        <input id="email1" type="email" class="form-control" name="email1" value="{{ $supplier->email1 }}" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inCharge2">負責人2 - 名稱</label>
                        <input id="inCharge2" type="text" class="form-control" name="inCharge2" value="{{ $supplier->inCharge2 }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tel2">負責人2 - 電話</label>
                        <input id="tel2" type="text" class="form-control" name="tel2" value="{{ $supplier->tel2 }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email2">負責人2 - 信箱</label>
                        <input id="email2" type="email" class="form-control" name="email2" value="{{ $supplier->email2 }}" readonly>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="comment">備註</label>
                        <textarea id="comment" name="comment" type="text" class="form-control" readonly>{{ $supplier->comment }}</textarea>             
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="updated_at">最新更新時間</label>
                        <input id="updated_at" type="text" class="form-control" name="updated_at" value="{{ $supplier->updated_at }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">建檔時間</label>
                        <input id="created_at" type="text" class="form-control" name="created_at" value="{{ $supplier   ->created_at }}" readonly>
                    </div>
                </div>
            </div>
            
            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('suppliers.edit', [$supplier->id]) }}" class="btn btn-block btn-success">
                        <i class="fas fa-edit mr-1"></i>
                        編輯資料
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>

        </div>
    </div>
	
@endsection

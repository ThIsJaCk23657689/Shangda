@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">
                            名稱
                        </label>
            
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" class="form-control"  value="{{ $consumer->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="shownID" class="col-md-3 col-form-label text-md-right">
                            簡稱
                        </label>
            
                        <div class="col-md-6">
                            <input id="shownID" name="shownID" type="text" class="form-control" value="{{ $consumer->shownID }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="act" class="col-md-3 col-form-label text-md-right">
                            帳號
                        </label>
            
                        <div class="col-md-6">
                            <input id="act" name="act" type="text" class="form-control"  value="{{ $consumer->act }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="taxID" class="col-md-3 col-form-label text-md-right">
                            統一編號
                        </label>
            
                        <div class="col-md-6">
                            <input id="taxID" name="taxID" type="text" class="form-control"  value="{{ $consumer->taxID }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="idNumber" class="col-md-3 col-form-label text-md-right">
                            身分證
                        </label>
            
                        <div class="col-md-6">
                            <input id="idNumber" name="idNumber" type="text" class="form-control" value="{{ $consumer->idNumber }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="tax" class="col-md-3 col-form-label text-md-right">
                            傳真
                        </label>
            
                        <div class="col-md-6">
                            <input id="tax" name="tax" type="text" class="form-control" value="{{ $consumer->tax }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inCharge1" class="col-md-3 col-form-label text-md-right">
                            聯絡人1 - 名稱
                        </label>
            
                        <div class="col-md-6">
                            <input id="inCharge1" name="inCharge1" type="text" class="form-control" value="{{ $consumer->inCharge1 }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inCharge2" class="col-md-3 col-form-label text-md-right">
                            聯絡人2 - 名稱
                        </label>
            
                        <div class="col-md-6">
                            <input id="inCharge2" name="inCharge2" type="text" class="form-control" value="{{ $consumer->inCharge2 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="tel1" class="col-md-3 col-form-label text-md-right">
                            聯絡人1 - 電話
                        </label>
            
                        <div class="col-md-6">
                            <input id="tel1" name="tel1" type="text" class="form-control" value="{{ $consumer->tel1 }}" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="tel2" class="col-md-3 col-form-label text-md-right">
                            聯絡人2 - 電話
                        </label>
            
                        <div class="col-md-6">
                            <input id="tel2" name="tel2" type="text" class="form-control" value="{{ $consumer->tel2 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="email1" class="col-md-3 col-form-label text-md-right">
                            聯絡人1 - 信箱
                        </label>
            
                        <div class="col-md-6">
                            <input id="email1" name="email1" type="email" class="form-control" value="{{ $consumer->email1 }}" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="email2" class="col-md-3 col-form-label text-md-right">
                            聯絡人2 - 信箱
                        </label>
            
                        <div class="col-md-6">
                            <input id="email2" name="email2" type="email" class="form-control" value="{{ $consumer->email2 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="monthlyCheckDate" class="col-md-3 col-form-label text-md-right">
                            月結日
                        </label>
            
                        <div class="col-md-4">
                            <input id="monthlyCheckDate" name="monthlyCheckDate" type="text" class="form-control" value="{{ $consumer->monthlyCheckDate ?? '無' }}" disabled>
                        </div>
            
                        <div class="col-md-5">
                            <input id="monthlyCheck" name="monthlyCheck" type="checkbox" value="" {{ ($consumer->monthlyCheckDate == null)?'checked':'' }} disabled>
                            <label for="monthlyCheck" class="col-form-label">
                                日結
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="uncheckedAmount" class="col-md-3 col-form-label text-md-right">
                            未沖帳金額
                        </label>
            
                        <div class="col-md-6">
                            <input id="uncheckedAmount" name="uncheckedAmount" type="text" class="form-control" value="{{ $consumer->uncheckedAmount ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="totalConsumption" class="col-md-3 col-form-label text-md-right">
                            總消費額
                        </label>
            
                        <div class="col-md-6">
                            <input id="totalConsumption" name="totalConsumption" type="text" class="form-control" value="{{ $consumer->totalConsumption ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="comment" class="col-md-3 col-form-label text-md-right">
                            備註
                        </label>
            
                        <div class="col-md-6">
                            <input id="comment" name="comment" type="text" class="form-control" value="{{ $consumer->comment }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="companyAddress" class="col-md-3 col-form-label text-md-right">
                            公司地址
                        </label>
            
                        <div class="col-md-9">
                            <input id="companyAddress" type="text" class="form-control" name="companyAddress" value="{{ $consumer->companyAddress }}" disabled>
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
            
                        <div class="col-md-9">
                            <input id="deliveryAddress" type="text" class="form-control" name="deliveryAddress" value="{{ $consumer->deliveryAddress }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="invoiceAddress" class="col-md-3 col-form-label text-md-right">
                            發票地址
                        </label>
            
                        <div class="col-md-9">
                            <input id="invoiceAddress" type="text" class="form-control" name="invoiceAddress" value="{{ $consumer->invoiceAddress }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="created_at" class="col-md-3 col-form-label text-md-right">
                            建立時間
                        </label>
            
                        <div class="col-md-9">
                            <input id="created_at" type="text" class="form-control" name="created_at" value="{{ $consumer->created_at }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="updated_at" class="col-md-3 col-form-label text-md-right">
                            最後更新時間
                        </label>
            
                        <div class="col-md-9">
                            <input id="updated_at" type="text" class="form-control" name="updated_at" value="{{ $consumer->updated_at }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('consumers.index') }}" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>
        </div>
    </div>
	
@endsection

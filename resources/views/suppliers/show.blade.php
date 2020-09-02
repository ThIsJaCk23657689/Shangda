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
                <div class="col-md-12 mb-2">
                    <h4>1. 供應商基本資訊</h4>
                </div>
            </div>

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
                        <input id="shortName" name="shortName" type="text" class="form-control mb-2" value="{{ $supplier->shortName ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taxId">統一編號</label>
                        <input id="taxId" name="taxId" type="text" class="form-control" value="{{ $supplier->taxId ?? '無' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel">電話</label>
                                <input id="tel" type="text" class="form-control" name="tel" value="{{ $supplier->tel ?? '無' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tax">傳真</label>
                                <input id="tax" type="text" class="form-control" name="tax" value="{{ $supplier->tax ?? '無' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>公司地址</label>
                                <input id="companyAddress" type="text" class="form-control" name="companyAddress" value="{{ $supplier->showAddress() }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">備註</label>
                                <textarea id="comment" name="comment" type="text" class="form-control" rows="4" readonly>{{ $supplier->comment ?? '無' }}</textarea>              
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
                        <label for="operator_name_1">聯絡窗口1 - 名稱</label>
                        <input id="operator_name_1" type="text" class="form-control" name="operator_name_1" value="{{ $supplier->operator_name_1 ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_tel_1">聯絡窗口1 - 電話</label>
                        <input id="operator_tel_1" type="text" class="form-control" name="operator_tel_1" value="{{ $supplier->operator_tel_1 ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_email_1">聯絡窗口1 - 信箱</label>
                        <input id="operator_email_1" type="email" class="form-control" name="operator_email_1" value="{{ $supplier->operator_email_1 ?? '無' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_name_2">聯絡窗口2 - 名稱</label>
                        <input id="operator_name_2" type="text" class="form-control" name="operator_name_2" value="{{ $supplier->operator_name_2 ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_tel_2">聯絡窗口2 - 電話</label>
                        <input id="operator_tel_2" type="text" class="form-control" name="operator_tel_2" value="{{ $supplier->operator_tel_2 ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator_email_2">聯絡窗口2 - 信箱</label>
                        <input id="operator_email_2" type="email" class="form-control" name="operator_email_2" value="{{ $supplier->operator_email_2 ?? '無' }}" readonly>
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
                        <input id="bank_name" type="text" class="form-control" name="bank_name" value="{{ $supplier->bank_name ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_branch_name">分行名稱</label>
                        <input id="bank_branch_name" type="text" class="form-control" name="bank_branch_name" value="{{ $supplier->bank_branch_name ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_code">銀行通匯代號</label>
                        <input id="bank_code" type="text" class="form-control" name="bank_code" value="{{ $supplier->bank_code ?? '無' }}" readonly>
                        <small class="form-text text-muted">銀行代號+分行代號</small>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bank_account">帳號</label>
                        <input id="bank_account" type="text" class="form-control" name="bank_account" value="{{ $supplier->bank_account ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bank_account_name">戶名</label>
                        <input id="bank_account_name" type="text" class="form-control" name="bank_account_name" value="{{ $supplier->bank_account_name ?? '無' }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="monthlyCheckDate">
                            <span class="text-danger mr-2">*</span>月結日
                        </label>
                        <select id="monthlyCheckDate" name="monthlyCheckDate" class="form-control mb-2" disabled>
                            <option value="0">請選擇...</option>
                            @for($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" {{ ($supplier->monthlyCheckDate == $i) ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="monthlyCheck" id="monthlyCheck" value="1" {{ ($supplier->monthlyCheckDate == 0) ? 'checked' : '' }} disabled>
                            <label class="custom-control-label" for="monthlyCheck">
                                <small>日結</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="updated_at">最新更新時間</label>
                        <input id="updated_at" type="text" class="form-control" name="updated_at" value="{{ $supplier->updated_at }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="created_at">建檔時間</label>
                        <input id="created_at" type="text" class="form-control" name="created_at" value="{{ $supplier->created_at }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('suppliers.edit', [$supplier->id]) }}" class="btn btn-block btn-success">
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

@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/consumers/show.js') }}" defer></script>
@endpush

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
        <div class="col-md-10">
            @if($consumer->account_type == 0)
            
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="form-group d-flex flex-column">
                            <label>顧客照片</label>
                            <img src="{{ $consumer->showPicture() }}" alt="" width="100%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_account">帳號</label>
                                    <input id="individual_account" name="individual_account" type="text" class="form-control" value="{{ $consumer->account }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_name">姓名</label>
                                    <input id="individual_name" name="individual_name" type="text" class="form-control" value="{{ $consumer->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_shortName">簡稱</label>
                                    <input id="individual_shortName" name="individual_shortName" type="text" class="form-control" value="{{ $consumer->shortName ?? '無' }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_gender">性別</label>
                                    <input id="individual_gender" name="individual_gender" type="text" class="form-control" value="{{ $consumer->showGender() }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_birthday">生日</label>
                                    <input id="individual_birthday" name="individual_birthday" type="text" class="form-control" value="{{ $consumer->birthday ?? '無' }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_monthlyCheckDate">月結日</label>
                                    <select id="individual_monthlyCheckDate" name="individual_monthlyCheckDate" class="form-control mb-2" disabled>
                                        @for ($i = 0; $i <= 31; $i++)
                                            <option value="$i" {{ ($consumer->monthlyCheckDate == $i)? 'selected' : '' }}>
                                                @if ($i == 0)
                                                    無
                                                @else    
                                                    {{ $i }}
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="individual_monthlyCheck" id="individual_monthlyCheck" value="1" disabled {{ ($consumer->monthlyCheckDate != 0)? '' : 'checked' }}>
                                        <label class="custom-control-label" for="individual_monthlyCheck">
                                            <small>日結</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_uncheckedAmount">未沖銷帳款</label>
                                    <input id="individual_uncheckedAmount" name="individual_uncheckedAmount" type="text" class="form-control" value="{{ $consumer->uncheckedAmount }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_totalConsumption">總消費額</label>
                                    <input id="individual_totalConsumption" name="individual_totalConsumption" type="text" class="form-control" value="{{ $consumer->totalConsumption }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="individual_comment">備註</label>
                                    <textarea id="individual_comment" name="individual_comment" type="text" class="form-control" rows="5" disabled>{{ $consumer->comment ?? '無' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="individual_phone">手機</label>
                            <input id="individual_phone" name="individual_phone" type="text" class="form-control" value="{{ $consumer->phone ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="individual_tel">電話</label>
                            <input id="individual_tel" name="individual_tel" type="text" class="form-control" value="{{ $consumer->tel ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="individual_email">信箱</label>
                            <input id="individual_email" name="individual_email" type="email" class="form-control" value="{{ $consumer->email }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="individual_lineID">Line ID</label>
                            <input id="individual_lineID" name="individual_lineID" type="text" class="form-control" value="{{ $consumer->lineID ?? '無' }}" disabled>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div id="individual_address_twzipcode" class="form-group">
                            <label>地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input id="individual_address_county" type="text" class="form-control" name="individual_address_county" value="{{ $consumer->address_county }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="individual_address_district" type="text" class="form-control" name="individual_address_district" value="{{ $consumer->address_district }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="individual_address_zipcode" type="text" class="form-control" name="individual_address_zipcode" value="{{ $consumer->address_zipcode }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="individual_address_others" type="text" class="form-control" name="individual_address_others" value="{{ $consumer->address_others }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else

                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="form-group d-flex flex-column">
                            <label>顧客照片</label>
                            <img src="{{ $consumer->showPicture() }}" alt="" width="100%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_account">帳號</label>
                                    <input id="company_account" name="company_account" type="text" class="form-control" value="{{ $consumer->account }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_taxID">統一編號</label>
                                    <input id="company_taxID" name="company_taxID" type="text" class="form-control" value="{{ $consumer->taxID }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="company_name">公司名稱</label>
                                    <input id="company_name" name="company_name" type="text" class="form-control" value="{{ $consumer->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label id="branch_label" for="company_branch" class="text-muted">分店名</label>
                                    <input id="company_branch" name="company_branch" type="text" class="form-control" value="{{ $consumer->branch ?? '無' }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_shortName">簡稱</label>
                                    <input id="company_shortName" name="company_shortName" type="text" class="form-control" value="{{ $consumer->shortName ?? '無' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_principal">負責人姓名</label>
                                    <input id="company_principal" name="company_principal" type="text" class="form-control" value="{{ $consumer->principal }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_monthlyCheckDate">月結日</label>
                                    <select id="company_monthlyCheckDate" name="company_monthlyCheckDate" class="form-control mb-2" disabled>
                                        @for ($i = 0; $i <= 31; $i++)
                                            <option value="$i" {{ ($consumer->monthlyCheckDate == $i)? 'selected' : '' }}>
                                                @if ($i == 0)
                                                    無
                                                @else    
                                                    {{ $i }}
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="company_monthlyCheck" id="company_monthlyCheck" value="1" disabled {{ ($consumer->monthlyCheckDate != 0)? '' : 'checked' }}>
                                        <label class="custom-control-label" for="company_monthlyCheck">
                                            <small>日結</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_uncheckedAmount">未沖銷帳款</label>
                                    <input id="company_uncheckedAmount" name="company_uncheckedAmount" type="text" class="form-control" value="{{ $consumer->uncheckedAmount }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_totalConsumption">總消費額</label>
                                    <input id="company_totalConsumption" name="company_totalConsumption" type="text" class="form-control" value="{{ $consumer->totalConsumption }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="company_comment">備註</label>
                                    <textarea id="company_comment" name="company_comment" type="text" class="form-control" rows="5" disabled>{{ $consumer->comment ?? '無' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <hr>
            
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_tel">公司電話</label>
                            <input id="company_tel" name="company_tel" type="text" class="form-control" value="{{ $consumer->tel ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_tax">公司傳真</label>
                            <input id="company_tax" name="company_tax" type="text" class="form-control" value="{{ $consumer->tax ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_email">
                                公司信箱
                            </label>
                            <input id="company_email" name="company_email" type="email" class="form-control" value="{{ $consumer->email ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company_lineID">Line ID</label>
                            <input id="company_lineID" name="company_lineID" type="text" class="form-control" value="{{ $consumer->lineID ?? '無' }}" disabled>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company_operator_name_1">聯絡窗口1 - 姓名</label>
                            <input id="company_operator_name_1" name="company_operator_name_1" type="text" class="form-control mb-2" value="{{ $consumer->operator_name_1 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_operator_tel_1">聯絡窗口1 - 電話</label>
                            <input id="company_operator_tel_1" name="company_operator_tel_1" type="text" class="form-control" value="{{ $consumer->operator_tel_1 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_operator_phone_1">聯絡窗口1 - 手機</label>
                            <input id="company_operator_phone_1" name="company_operator_phone_1" type="text" class="form-control" value="{{ $consumer->operator_phone_1 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_operator_email_1">聯絡窗口1 - 信箱</label>
                            <input id="company_operator_email_1" name="company_operator_email_1" type="email" class="form-control" value="{{ $consumer->operator_email_1 ?? '無' }}" disabled>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company_operator_name_2">聯絡窗口2 - 姓名</label>
                            <input id="company_operator_name_2" name="company_operator_name_2" type="text" class="form-control mb-2" value="{{ $consumer->operator_name_2 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_operator_tel_2">聯絡窗口2 - 電話</label>
                            <input id="company_operator_tel_2" name="company_operator_tel_2" type="text" class="form-control" value="{{ $consumer->operator_tel_2 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_operator_phone_2">聯絡窗口2 - 手機</label>
                            <input id="company_operator_phone_2" name="company_operator_phone_2" type="text" class="form-control" value="{{ $consumer->operator_phone_2 ?? '無' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_operator_email_2">聯絡窗口2 - 信箱</label>
                            <input id="company_operator_email_2" name="company_operator_email_2" type="email" class="form-control" value="{{ $consumer->operator_email_2 ?? '無' }}" disabled>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div id="company_address_twzipcode" class="form-group">
                            <label>公司地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input id="company_address_county" type="text" class="form-control" name="company_address_county" value="{{ $consumer->address_county }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="company_address_district" type="text" class="form-control" name="company_address_district" value="{{ $consumer->address_district }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="company_address_zipcode" type="text" class="form-control" name="company_address_zipcode" value="{{ $consumer->address_zipcode }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="company_address_others" type="text" class="form-control" name="company_address_others" value="{{ $consumer->address_others }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="company_deliveryAddress_twzipcode" class="form-group">
                            <label>送貨地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input id="company_deliveryAddress_county" type="text" class="form-control" name="company_deliveryAddress_county" value="{{ $consumer->deliveryAddress_county }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="company_deliveryAddress_district" type="text" class="form-control" name="company_deliveryAddress_district" value="{{ $consumer->deliveryAddress_district }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input id="company_deliveryAddress_zipcode" type="text" class="form-control" name="company_deliveryAddress_zipcode" value="{{ $consumer->deliveryAddress_zipcode }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <input id="company_deliveryAddress_others" type="text" class="form-control" name="company_deliveryAddress_others" value="{{ $consumer->deliveryAddress_others }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">建立時間</label>
                        <input id="created_at" type="text" class="form-control" name="created_at" value="{{ $consumer->created_at }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="updated_at">最後更新時間</label>
                        <input id="updated_at" type="text" class="form-control" name="updated_at" value="{{ $consumer->updated_at }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="account_type">帳號類型</label>
                        <input id="account_type" type="text" class="form-control" name="account_type" value="{{ $consumer->showAccountType() }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="who_created">創建類型</label>
                        <input id="who_created" type="text" class="form-control" name="who_created" value="{{ $consumer->showWhoCreated() }}" disabled>
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

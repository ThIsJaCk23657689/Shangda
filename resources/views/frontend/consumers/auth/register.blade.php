@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/consumers/register.js') }}" defer></script>
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/register.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <section id="register" class="header">
        <div class="bg-image"></div>
        <div class="bg-gray"></div>
        <div class="container">
            <h2 class="title">註冊</h2>
        </div>

        {{-- <span id="ConsumerRegisterURL" class="d-none">{{ route('consumers.register') }}</span> --}}


    </section>
    <section class="form-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    {{-- 選擇帳號類型 --}}
                    @if(!$errors->any())
                        <div id="step1" class="row">
                            <div class="col-md-12 subtitle">
                                <h3>1. 帳號類型</h3>
                                <small>請先選擇註冊身分</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button id="individual_btn" type="button" class="btn btn-block btn-info">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        個人註冊
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button id="company_btn" type="button" class="btn btn-block btn-info">
                                        <i class="far fa-building mr-2"></i>
                                        公司註冊
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="goback2step1" class="row" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="goback2step1_btn" type="button" class="btn btn-block btn-secondary">
                                        <i class="fas fa-undo-alt mr-2"></i>
                                        重新選擇帳號類型
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- 個人帳戶註冊 --}}
                    <form id="individual_form" method="POST" action="{{ route('consumers.register') }}" enctype="multipart/form-data" style="{{ ( old('account_type') == 'individual' )? '' : 'display: none' }}">
                        @csrf
                        <input id="individual_account_type" name="account_type" type="hidden" value="individual">

                        {{-- 帳戶資訊(帳號、密碼、密碼確認) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>2. 填寫帳號資訊</h3>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_account">
                                        <span class="text-danger mr-2">*</span>帳號
                                    </label>
                                    <input id="individual_account" name="individual_account" type="text" class="form-control mb-2 @error('individual_account') is-invalid @enderror" value="{{ old('individual_account') }}" required autocomplete="off" placeholder="請輸入6~30個英文或數字">
                                    @error('individual_account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_password">
                                        <span class="text-danger mr-2">*</span>密碼
                                    </label>
                                    <input id="individual_password" name="individual_password" type="password" class="form-control @error('individual_password') is-invalid @enderror" value="" required autocomplete="off" placeholder="請輸入至少6個英文或數字">
                                    @error('individual_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="individual_password_confirmation">
                                        <span class="text-danger mr-2">*</span>密碼確認
                                    </label>
                                    <input id="individual_password_confirmation" name="individual_password_confirmation" type="password" class="form-control @error('individual_password_confirmation') is-invalid @enderror" value="" required autocomplete="off" placeholder="請再次輸入密碼">

                                    @error('individual_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- 基本資訊(大頭貼、身分證、姓名、簡稱、性別、生日、月結日、未沖銷帳款、總消費額、備註) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>3. 填寫基本資訊</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="individual_name">
                                                <span class="text-danger mr-2">*</span>姓名
                                            </label>
                                            <input id="individual_name" name="individual_name" type="text" class="form-control mb-2 @error('individual_name') is-invalid @enderror" value="{{ old('individual_name') }}" required autocomplete="off" placeholder="例：王大明">
                                            @error('individual_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="individual_idNumber">
                                                <span class="text-danger mr-2">*</span>身分證
                                            </label>
                                            <input id="individual_idNumber" name="individual_idNumber" type="text" class="form-control @error('individual_idNumber') is-invalid @enderror" value="{{ old('individual_idNumber') }}" required autocomplete="off" placeholder="例：A234567890">
                                            @error('individual_idNumber')
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
                                            <label for="individual_gender">
                                                <span class="text-danger mr-2">*</span>性別
                                            </label>
                                            <select id="individual_gender" name="individual_gender" class="form-control @error('individual_gender') is-invalid @enderror" required>
                                                <option value="0" {{ ( old('individual_gender') == '0' )? 'selected' : '' }}>女</option>
                                                <option value="1" {{ ( old('individual_gender') == '1' )? 'selected' : '' }}>男</option>
                                                <option value="2" {{ ( old('individual_gender') == '2' )? 'selected' : '' }}>其他</option>
                                            </select>
                                            @error('individual_gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="individual_monthlyCheckDate">
                                                <span class="text-danger mr-2">*</span>月結日
                                            </label>
                                            <select id="individual_monthlyCheckDate" name="individual_monthlyCheckDate" class="form-control mb-2 @error('individual_monthlyCheckDate') is-invalid @enderror" {{ old('individual_monthlyCheckDate')?'':'disabled' }}>
                                                <option value="0">請選擇...</option>
                                                @for($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" {{ ( old('individual_monthlyCheckDate') == $i )? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="individual_monthlyCheck" id="individual_monthlyCheck" value="1" {{ old('individual_monthlyCheckDate')?'':'checked' }}>
                                                <label class="custom-control-label" for="individual_monthlyCheck">
                                                    <small>日結</small>
                                                </label>
                                            </div>
                                            @error('individual_monthlyCheckDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input id="individual_uncheckedAmount" name="individual_uncheckedAmount" type="text" class="form-control" value="0" autocomplete="off" required style="display:none;">
                                <input id="individual_totalConsumption" name="individual_totalConsumption" type="text" class="form-control"  value="0" autocomplete="off" required style="display:none;">

                            </div>
                        </div>

                        {{-- 聯絡資訊(手機、電話、信箱、Line ID、地址) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>4. 填寫聯絡資訊</h3>
                                <small>手機與電話欄位擇一填寫。</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="individual_phone">
                                        <span class="text-warning mr-2">*</span>手機
                                    </label>
                                    <input id="individual_phone" name="individual_phone" type="text" class="form-control @error('individual_phone') is-invalid @enderror" value="{{ old('individual_phone') }}" autocomplete="off" placeholder="例：0912345678" required>
                                    <small class="form-text text-muted">手機號碼不需+886。</small>
                                    @error('individual_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="individual_tel">
                                        <span class="text-warning mr-2">*</span>電話
                                    </label>
                                    <input id="individual_tel" name="individual_tel" type="text" class="form-control @error('individual_tel') is-invalid @enderror" value="{{ old('individual_tel') }}" autocomplete="off" placeholder="例：0412345678">
                                    <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
                                    @error('individual_tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="individual_email">
                                        <span class="text-danger mr-2">*</span>信箱
                                    </label>
                                    <input id="individual_email" name="individual_email" type="email" class="form-control @error('individual_email') is-invalid @enderror" value="{{ old('individual_email') }}" autocomplete="off" required placeholder="例：test@example.com">
                                    <small class="form-text text-muted">請填寫正確並可使用之信箱。</small>
                                    @error('individual_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="individual_address_twzipcode" class="form-group">
                                    <label><span class="text-danger mr-2">*</span>地址</label>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <div data-role="county" data-style="form-control" data-name="individual_address_county" data-value="{{ old('individual_address_county') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="district" data-style="form-control" data-name="individual_address_district" data-value="{{ old('individual_address_district') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="zipcode" data-style="form-control" data-name="individual_address_zipcode" data-value="{{ old('individual_address_zipcode') }}" data-required="1"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="individual_address_others" type="text" class="form-control @error('individual_address_others') is-invalid @enderror" name="individual_address_others" value="{{ old('individual_address_others') }}" required autocomplete="off">
                                            @error('individual_address_others')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        確認新增
                                    </button>
                                    <a href="{{ route('consumers.index') }}" class="btn btn-block btn-danger">
                                        返回列表
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>

                    {{-- 公司帳戶註冊 --}}
                    <form id="company_form" method="POST" action="{{ route('consumers.register') }}" enctype="multipart/form-data" style="{{ ( old('account_type') == 'company' )? '' : 'display: none' }}">
                        @csrf
                        <input id="company_account_type" name="account_type" type="hidden" value="company">

                        {{-- 帳戶資訊(帳號、密碼、密碼確認) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>2. 填寫帳號資訊</h3>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_account">
                                        <span class="text-danger mr-2">*</span>帳號
                                    </label>
                                    <input id="company_account" name="company_account" type="text" class="form-control mb-2 @error('company_account') is-invalid @enderror" value="{{ old('company_account') }}" required autocomplete="off" placeholder="請輸入6~30個英文或數字">
                                    @error('company_account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_password">
                                        <span class="text-danger mr-2">*</span>密碼
                                    </label>
                                    <input id="company_password" name="company_password" type="password" class="form-control @error('company_password') is-invalid @enderror" value="" required autocomplete="off" placeholder="請輸入至少6個英文或數字">
                                    @error('company_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_password_confirmation">
                                        <span class="text-danger mr-2">*</span>密碼確認
                                    </label>
                                    <input id="company_password_confirmation" name="company_password_confirmation" type="password" class="form-control @error('company_password_confirmation') is-invalid @enderror" value="" required autocomplete="off" placeholder="請再次輸入密碼">

                                    @error('company_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- 基本資訊(大頭貼、公司名稱、分店名、簡稱、統一編號、負責人姓名、負責人身分證、月結日、未沖銷帳款、總消費額、備註) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>3. 填寫基本資訊</h3>
                                <small>請先填寫統一編號，可以自動填寫部分欄位</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_taxID">
                                                <span class="text-danger mr-2">*</span>統一編號
                                            </label>
                                            <input id="company_taxID" name="company_taxID" type="text" class="form-control @error('company_taxID') is-invalid @enderror" value="{{ old('company_taxID') }}" required autocomplete="off" placeholder="例：12345678">
                                            @error('company_taxID')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_taxID_type">
                                                <span class="text-danger mr-2">*</span>統編類型
                                            </label>
                                            <input id="company_taxID_type" name="company_taxID_type" type="text" class="form-control" value="{{ old('company_taxID_type') }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="company_name">
                                                <span class="text-danger mr-2">*</span>公司名稱
                                            </label>
                                            <input id="company_name" name="company_name" type="text" class="form-control mb-2 @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" required autocomplete="off" placeholder="例：尚達塑膠有限公司">
                                            @error('company_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label id="branch_label" for="company_branch" class="text-muted">
                                                <span id="branch_required_tag" class="text-danger mr-2" style="display: none;">*</span>分店名
                                            </label>
                                            <input id="company_branch" name="company_branch" type="text" class="form-control mb-2 @error('company_branch') is-invalid @enderror" value="{{ old('company_branch') }}" autocomplete="off" placeholder="例：文心店" disabled>
                                            @error('company_branch')
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
                                            <label for="company_principal">
                                                <span class="text-danger mr-2">*</span>負責人姓名
                                            </label>
                                            <input id="company_principal" name="company_principal" type="text" class="form-control mb-2 @error('company_principal') is-invalid @enderror" value="{{ old('company_principal') }}" required autocomplete="off" placeholder="例：王大明">
                                            @error('company_principal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_monthlyCheckDate">
                                                <span class="text-danger mr-2">*</span>月結日
                                            </label>
                                            <select id="company_monthlyCheckDate" name="company_monthlyCheckDate" class="form-control mb-2 @error('company_monthlyCheckDate') is-invalid @enderror" {{ old('company_monthlyCheckDate')?'':'disabled' }}>
                                                <option value="0">請選擇...</option>
                                                @for($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" {{ ( old('company_monthlyCheckDate') == $i )? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="company_monthlyCheck" id="company_monthlyCheck" value="1" {{ old('company_monthlyCheckDate')?'':'ckecked' }}>
                                                <label class="custom-control-label" for="company_monthlyCheck">
                                                    <small>日結</small>
                                                </label>
                                            </div>
                                            @error('company_monthlyCheckDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input id="company_uncheckedAmount" name="company_uncheckedAmount" type="text" class="form-control" value="0" autocomplete="off" required style="display: none;">
                                <input id="company_totalConsumption" name="company_totalConsumption" type="text" class="form-control" value="0" autocomplete="off" required style="display: none;">

                            </div>
                        </div>

                        {{-- 聯絡資訊(公司電話、公司傳真、公司信箱、Line ID、聯絡人姓名、聯絡人電話、聯絡人手機、聯絡人信箱、聯絡人性別、公司地址、送貨地址) --}}
                        <div class="row">
                            <div class="col-md-12 subtitle">
                                <h3>4. 填寫聯絡資訊</h3>
                                <small>聯絡人手機與聯絡人電話欄位擇一填寫。</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="company_tel">公司電話</label>
                                    <input id="company_tel" name="company_tel" type="text" class="form-control @error('company_tel') is-invalid @enderror" value="{{ old('company_tel') }}" autocomplete="off" placeholder="例：0412345678">
                                    <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>
                                    @error('company_tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="company_tax">公司傳真</label>
                                    <input id="company_tax" name="company_tax" type="text" class="form-control @error('company_tax') is-invalid @enderror" value="{{ old('company_tax') }}" autocomplete="off" placeholder="例：0412345678">
                                    <small class="form-text text-muted">傳真請包含區碼並省略"-"。</small>
                                    @error('company_tax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_email">
                                        <span class="text-danger mr-2">*</span>公司信箱
                                    </label>
                                    <input id="company_email" name="company_email" type="email" class="form-control @error('company_email') is-invalid @enderror" value="{{ old('company_email') }}" autocomplete="off" placeholder="例：test@example.com">
                                    @error('company_email')
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
                                    <label for="company_operator_name">
                                        <span class="text-danger mr-2">*</span>聯絡人姓名
                                    </label>
                                    <input id="company_operator_name" name="company_operator_name" type="text" class="form-control mb-2 @error('company_operator_name') is-invalid @enderror" value="{{ old('company_operator_name') }}" required autocomplete="off" placeholder="例：王大明">

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isSameAsPrincipal" value="1">
                                        <label class="custom-control-label" for="isSameAsPrincipal">
                                            <small>與負責人相同</small>
                                        </label>
                                    </div>

                                    @error('company_operator_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_operator_tel">
                                        <span class="text-warning mr-2">*</span>聯絡人電話
                                    </label>
                                    <input id="company_operator_tel" name="company_operator_tel" type="text" class="form-control @error('company_operator_tel') is-invalid @enderror" value="{{ old('company_operator_tel') }}" autocomplete="off" placeholder="例：0412345678">
                                    <small class="form-text text-muted">電話請包含區碼並省略"-"。</small>

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isSameAsComTel" value="1">
                                        <label class="custom-control-label" for="isSameAsComTel">
                                            <small>與公司電話相同</small>
                                        </label>
                                    </div>

                                    @error('company_operator_tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_operator_phone">
                                        <span class="text-warning mr-2">*</span>聯絡人手機
                                    </label>
                                    <input id="company_operator_phone" name="company_operator_phone" type="text" class="form-control @error('company_operator_phone') is-invalid @enderror" value="{{ old('company_operator_phone') }}" autocomplete="off" placeholder="例：0912345678">
                                    <small class="form-text text-muted">手機號碼不需+886</small>
                                    @error('company_operator_phone')
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
                                    <label for="company_operator_email">聯絡人信箱</label>
                                    <input id="company_operator_email" name="company_operator_email" type="email" class="form-control @error('company_operator_email') is-invalid @enderror" value="{{ old('company_operator_email') }}" autocomplete="off" placeholder="例：test@example.com">
                                    <small class="form-text text-muted">此信箱不綁定帳號，用於聯絡</small>

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isSameAsComEmail" value="1">
                                        <label class="custom-control-label" for="isSameAsComEmail">
                                            <small>與公司信箱相同</small>
                                        </label>
                                    </div>

                                    @error('company_operator_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_operator_gender">
                                        <span class="text-danger mr-2">*</span>聯絡人性別
                                    </label>
                                    <select id="company_operator_gender" name="company_operator_gender" class="form-control @error('company_operator_gender') is-invalid @enderror" required>
                                        <option value="0" {{ ( old('company_operator_gender') == '0' )? 'selected' : '' }}>女</option>
                                        <option value="1" {{ ( old('company_operator_gender') == '1' )? 'selected' : '' }}>男</option>
                                        <option value="2" {{ ( old('company_operator_gender') == '2' )? 'selected' : '' }}>其他</option>
                                    </select>
                                    @error('company_operator_gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="company_address_twzipcode" class="form-group">
                                    <label><span class="text-danger mr-2">*</span>公司地址</label>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <div data-role="county" data-style="form-control" data-name="company_address_county" data-value="{{ old('company_address_county') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="district" data-style="form-control" data-name="company_address_district" data-value="{{ old('company_address_district') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="zipcode" data-style="form-control" data-name="company_address_zipcode" data-value="{{ old('company_address_zipcode') }}" data-required="1"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="company_address_others" type="text" class="form-control @error('company_address_others') is-invalid @enderror" name="company_address_others" value="{{ old('company_address_others') }}" autocomplete="off" required>
                                            @error('company_address_others')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="company_deliveryAddress_twzipcode" class="form-group">
                                    <label><span class="text-danger mr-2">*</span>送貨地址</label>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <div data-role="county" data-style="form-control" data-name="company_deliveryAddress_county" data-value="{{ old('company_deliveryAddress_county') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="district" data-style="form-control" data-name="company_deliveryAddress_district" data-value="{{ old('company_deliveryAddress_district') }}" data-required="1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div data-role="zipcode" data-style="form-control" data-name="company_deliveryAddress_zipcode" data-value="{{ old('company_deliveryAddress_zipcode') }}" data-required="1"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <input id="company_deliveryAddress_others" type="text" class="form-control @error('company_deliveryAddress_others') is-invalid @enderror" name="company_deliveryAddress_others" value="{{ old('company_deliveryAddress_others') }}" autocomplete="off" required>
                                            @error('company_deliveryAddress_others')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="isSameAsComAddress" id="isSameAsComAddress" value="1" {{ (old('isSameAsComAddress') == 1)? 'checked' : '' }}>
                                                <label class="custom-control-label" for="isSameAsComAddress">
                                                    <small>與公司地址相同</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        確認新增
                                    </button>
                                    <a href="{{ route('consumers.login') }}" class="btn btn-block btn-danger">
                                        返回列表
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

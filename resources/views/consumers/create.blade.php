@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
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

    <div id="consumer">
        <span id="ConsumersIndexURL" class="d-none">{{ route('consumers.index') }}</span>
        <span id="ConsumersStoreURL" class="d-none">{{ route('consumers.store') }}</span>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div id="step1" class="row">
                    <div class="col-md-12 mb-2">
                        <h4>1. 帳戶類型</h4>
                        <small>請先選擇欲要創建顧客帳戶的類型</small>
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
                                重新選擇帳戶類型
                            </button>
                        </div>
                    </div>
                </div>

                <individual-consumer-create-form :uploadimg="'{{ asset('images/consumers/upload-default.png') }}'"></individual-consumer-create-form>
                <company-consumer-create-form :uploadimg="'{{ asset('images/consumers/upload-default.png') }}'"></company-consumer-create-form>
            </div>
        </div>
    </div>

@endsection

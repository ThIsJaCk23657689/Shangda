@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/frontend/consumers/register.js') }}" defer></script>
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

            <div id="consumer">
                <span id="ConsumersIndexURL" class="d-none">{{ route('consumers.login') }}</span>
                <span id="ConsumersStoreURL" class="d-none">{{ route('consumers.register') }}</span>

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

                        <individual-consumer-create-form :uploadimg="'{{ asset('images/consumers/upload-default.png') }}'" :formtype="'frontend'"></individual-consumer-create-form>
                        <company-consumer-create-form :uploadimg="'{{ asset('images/consumers/upload-default.png') }}'" :formtype="'frontend'"></company-consumer-create-form>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection

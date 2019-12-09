@extends('layouts.backend.master')

@section('content')
				
	@include('partials.backend.breadcrumbs')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">*供應商名稱</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                        <input id="shortName" type="text" class="form-control @error('shortName') is-invalid @enderror" name="shortName" value="{{ old('shortName') }}" autocomplete="shortName" autofocus>

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
                        <input id="taxId" type="text" class="form-control @error('taxId') is-invalid @enderror" name="taxId" value="{{ old('taxId') }}" autocomplete="taxId" autofocus>

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
                        <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" autocomplete="tel" autofocus>

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
                        <input id="tax" type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value="{{ old('tax') }}" autocomplete="tax" autofocus>

                        @error('tax')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="inCharge1" class="col-md-4 col-form-label text-md-right">*負責人1 - 名稱</label>

                    <div class="col-md-6">
                        <input id="inCharge1" type="text" class="form-control @error('inCharge1') is-invalid @enderror" name="inCharge1" value="{{ old('inCharge1') }}" autocomplete="inCharge1" autofocus>

                        @error('inCharge1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel1" class="col-md-4 col-form-label text-md-right">*負責人1 - 電話</label>

                    <div class="col-md-6">
                        <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') }}" autocomplete="tel1" autofocus>

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
                        <input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ old('email1') }}" autocomplete="email1" autofocus>

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
                        <input id="inCharge2" type="text" class="form-control @error('inCharge2') is-invalid @enderror" name="inCharge2" value="{{ old('inCharge2') }}" autocomplete="inCharge2" autofocus>

                        @error('inCharge2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel1" class="col-md-4 col-form-label text-md-right">負責人2 - 電話</label>

                    <div class="col-md-6">
                        <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') }}" autocomplete="tel1" autofocus>

                        @error('tel1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email2" class="col-md-4 col-form-label text-md-right">負責人2 - 信箱</label>

                    <div class="col-md-6">
                        <input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ old('email2') }}" autocomplete="email2" autofocus>

                        @error('email2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="companyAddress" class="col-md-4 col-form-label text-md-right">*公司地址</label>

                    <div class="col-md-6">
                        <input id="companyAddress" type="email" class="form-control @error('companyAddress') is-invalid @enderror" name="companyAddress" value="{{ old('companyAddress') }}" autocomplete="companyAddress" autofocus>

                        @error('companyAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="deliveryAddress" class="col-md-4 col-form-label text-md-right">*送貨地址</label>

                    <div class="col-md-6">
                        <input id="deliveryAddress" type="email" class="form-control @error('deliveryAddress') is-invalid @enderror" name="deliveryAddress" value="{{ old('deliveryAddress') }}" autocomplete="deliveryAddress" autofocus>

                        @error('deliveryAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="invoiceAddress" class="col-md-4 col-form-label text-md-right">*發票地址</label>

                    <div class="col-md-6">
                        <input id="invoiceAddress" type="email" class="form-control @error('invoiceAddress') is-invalid @enderror" name="invoiceAddress" value="{{ old('invoiceAddress') }}" autocomplete="invoiceAddress" autofocus>

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
                        <input id="comment" type="email" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" autocomplete="comment" autofocus>

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
                            確認新增
                        </button>
                        <button type="type" class="btn btn-block btn-danger">
                            返回上一頁
                        </button>
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div> --}}

            </form>
        </div>
    </div>
	
@endsection

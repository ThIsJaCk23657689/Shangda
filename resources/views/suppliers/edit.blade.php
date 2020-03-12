@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/suppliers/create.js') }}" defer></script>
@endpush    

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
        <div class="col-md-10">
            <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">
                                <span class="text-danger mr-2">*</span>供應商名稱
                            </label>
                            <input id="name" name="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') ?? $supplier->name }}" required autocomplete="off" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shortName">供應商簡稱</label>
                            <input id="shortName" name="shortName" type="text" class="form-control mb-2 @error('shortName') is-invalid @enderror" value="{{ old('shortName') ?? $supplier->shortName }}" autocomplete="off">
                            @error('shortName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="taxId">統一編號</label>
                            <input id="taxId" name="taxId" type="text" class="form-control @error('taxId') is-invalid @enderror" value="{{ old('taxId') ?? $supplier->taxId }}" autocomplete="taxId">
                            @error('taxId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tel">電話</label>
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') ?? $supplier->tel }}" autocomplete="tel">
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tax">傳真</label>
                            <input id="tax" type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value="{{ old('tax') ?? $supplier->tax }}" autocomplete="tax">
                            @error('tax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="CompanyAddress_twzipcode" class="form-group">
                            <label><span class="text-danger mr-2">*</span>公司地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div data-role="county" data-style="form-control" data-name="CompanyAddress_county" data-value="{{ old('CompanyAddress_county') ?? $supplier->CompanyAddress_county }}"></div>
                                </div>
                                <div class="col-md-4">
                                    <div data-role="district" data-style="form-control" data-name="CompanyAddress_district" data-value="{{ old('CompanyAddress_district') ?? $supplier->CompanyAddress_district }}"></div>
                                </div>
                                <div class="col-md-4">
                                    <div data-role="zipcode" data-style="form-control" data-name="CompanyAddress_zipcode" data-value="{{ old('CompanyAddress_zipcode') ?? $supplier->CompanyAddress_zipcode }}"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="CompanyAddress_others" type="text" class="form-control @error('CompanyAddress_others') is-invalid @enderror" name="CompanyAddress_others" value="{{ old('CompanyAddress_others') ?? $supplier->CompanyAddress_others }}" autocomplete="off" required>
                                    @error('CompanyAddress_others')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inCharge1"><span class="text-danger mr-2">*</span>負責人1 - 名稱</label>
                            <input id="inCharge1" type="text" class="form-control @error('inCharge1') is-invalid @enderror" name="inCharge1" value="{{ old('inCharge1') ?? $supplier->inCharge1 }}" autocomplete="inCharge1" required>
                            @error('inCharge1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel1"><span class="text-danger mr-2">*</span>負責人1 - 電話</label>
                            <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') ?? $supplier->tel1 }}" autocomplete="tel1" required>
                            @error('tel1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email1">負責人1 - 信箱</label>
                            <input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ old('email1') ?? $supplier->email1 }}" autocomplete="email1">
                            @error('email1')
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
                            <label for="inCharge2">負責人2 - 名稱</label>
                            <input id="inCharge2" type="text" class="form-control @error('inCharge2') is-invalid @enderror" name="inCharge2" value="{{ old('inCharge2') ?? $supplier->inCharge2 }}" autocomplete="inCharge2">
                            @error('inCharge2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel2">負責人2 - 電話</label>
                            <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2" value="{{ old('tel2') ?? $supplier->tel2 }}" autocomplete="tel2">
                            @error('tel2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email2">負責人2 - 信箱</label>
                            <input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ old('email2') ?? $supplier->email2 }}" autocomplete="email2">
                            @error('email2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="comment">備註</label>
                            <textarea id="comment" name="comment" type="text" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') ?? $supplier->comment }}</textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                 
                        </div>
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

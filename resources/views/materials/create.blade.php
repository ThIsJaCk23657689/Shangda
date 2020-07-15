@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/materials/create.js') }}" defer></script>
@endpush

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Materials') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="material_create_form" method="POST" action="{{ route('materials.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        原物料名稱
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="of" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shortName" class="col-md-4 col-form-label text-md-right">原物料簡稱</label>

                    <div class="col-md-6">
                        <input id="shortName" type="text" class="form-control @error('shortName') is-invalid @enderror" name="shortName" value="{{ old('shortName') }}" autocomplete="off">

                        @error('shortName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="internationalNum" class="col-md-4 col-form-label text-md-right">國際條碼</label>

                    <div class="col-md-6">
                        <input id="internationalNum" type="text" class="form-control @error('internationalNum') is-invalid @enderror" name="internationalNum" value="{{ old('internationalNum') }}" autocomplete="off">

                        @error('internationalNum')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="unitPrice" class="col-md-4 col-form-label text-md-right">單價</label>

                    <div class="col-md-6">
                        <input id="unitPrice" type="text" class="form-control @error('unitPrice') is-invalid @enderror" name="unitPrice" value="{{ old('unitPrice') ?? 0 }}" autocomplete="off">

                        @error('unitPrice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stock" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        目前存貨量
                    </label>

                    <div class="col-md-4">
                        <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') ?? 0 }}" autocomplete="off">
                        
                        @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <select id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit">
                            <option value="1" selected>公斤</option>
                            <option value="2">公噸</option>
                        </select>

                        @error('unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="safeQuantity" class="col-md-4 col-form-label text-md-right">
                        安全存貨量
                    </label>

                    <div class="col-md-4">
                        <input id="safeQuantity" type="text" class="form-control @error('safeQuantity') is-invalid @enderror" name="safeQuantity" value="{{ old('safeQuantity') ?? 0 }}" autocomplete="off">
                        
                        @error('safeQuantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comment" class="col-md-4 col-form-label text-md-right">備註</label>

                    <div class="col-md-6">
                        <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" autocomplete="off">

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
                        <a href="{{ route('materials.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
	
@endsection

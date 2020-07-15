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
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">
            
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">
                        原物料名稱
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $material->name }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shortName" class="col-md-4 col-form-label text-md-right">原物料簡稱</label>

                    <div class="col-md-6">
                        <input id="shortName" type="text" class="form-control" name="shortName" value="{{ $material->shortName }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="internationalNum" class="col-md-4 col-form-label text-md-right">國際條碼</label>

                    <div class="col-md-6">
                        <input id="internationalNum" type="text" class="form-control" name="internationalNum" value="{{ $material->internationalNum }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="unitPrice" class="col-md-4 col-form-label text-md-right">單價</label>

                    <div class="col-md-6">
                        <input id="unitPrice" type="text" class="form-control" name="unitPrice" value="{{ $material->unitPrice }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stock" class="col-md-4 col-form-label text-md-right">
                        目前存貨量
                    </label>

                    <div class="col-md-4">
                        <input id="stock" type="text" class="form-control" name="stock" value="{{ $material->showStock() }}" disabled>
                    </div>

                    <div class="col-md-2">
                        <input id="unit" type="text" class="form-control" name="unit" value="{{ $material->showUnit() }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="safeQuantity" class="col-md-4 col-form-label text-md-right">
                        安全存貨量
                    </label>

                    <div class="col-md-4">
                        <input id="safeQuantity" type="text" class="form-control" name="safeQuantity" value="{{ $material->safeQuantity }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comment" class="col-md-4 col-form-label text-md-right">備註</label>

                    <div class="col-md-6">
                        <input id="comment" type="email" class="form-control" name="comment" value="{{ $material->comment }}" disabled>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <a href="{{ route('materials.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

        </div>
    </div>
	
@endsection

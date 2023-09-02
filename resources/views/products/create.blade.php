@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/products/create.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('products.index') }}">{{ __('Products') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div id="product" class="row justify-content-center">

        <span id="getMeterialsName" style="display: none;">{{ route('materials.showName') }}</span>
		<span id="getMeterialInfo" style="display: none;">{{ route('materials.getInfo') }}</span>

        <div class="col-md-10">
            <form id="product_create_form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shownID">
                                <span class="text-danger mr-2">*</span>商品編號
                            </label>
                            <input id="shownID" name="shownID" type="text" class="form-control mb-2 @error('shownID') is-invalid @enderror" value="{{ old('shownID') }}" autocomplete="off" placeholder="商品編號會自動生產">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="isManualID" id="ManualID" value="1" checked>
                                <label class="custom-control-label" for="ManualID">
                                    <small>手動編號</small>
                                </label>
                            </div>

                            @error('shownID')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">
                                <span class="text-danger mr-2">*</span>商品名稱
                            </label>

                            <input id="name" name="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off" placeholder="商品名稱預設會自動命名">

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="isManualNamed" id="ManualNamed" value="1" checked>
                                <label class="custom-control-label" for="ManualNamed">
                                    <small>手動命名</small>
                                </label>
                            </div>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="internationalNum">
                                國際條碼
                            </label>
                            <input id="internationalNum" name="internationalNum" type="text" class="form-control @error('internationalNum') is-invalid @enderror" value="{{ old('internationalNum') }}" autocomplete="off">
                            @error('internationalNum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <pictures-upload ref="picturesUpload"></pictures-upload>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specification">
                                        商品規格
                                    </label>
                                    <input id="specification" name="specification" type="text" class="form-control @error('specification') is-invalid @enderror" value="{{ old('specification') }}" autocomplete="off" aria-describedby="SpecificationHelp">
                                    <small id="SpecificationHelp" class="form-text text-muted">塑膠袋的大小（單位：兩、台斤）</small>
                                    @error('specification')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color">
                                        商品顏色或花樣
                                    </label>
                                    <input id="color" name="color" type="text" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" autocomplete="off">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weight">
                                商品重量（單位：兩）
                            </label>
                            <input id="weight" name="weight" type="text" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" autocomplete="off" placeholder="塑膠袋一包的重量">
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">
                                        商品類別
                                    </label>

                                    <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                        @foreach ($categories as $category)
                                            @if($category->id != 2)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-auto my-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input mr-2" id="isCustomize" name="isCustomize" value="1">
                                        <label class="custom-control-label" for="isCustomize">是否為客製化商品</label>
                                    </div>
                                </div>
                                <div class="col-auto my-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input mr-2" id="isPublic" name="isPublic" value="1">
                                        <label class="custom-control-label" for="isPublic">是否公開此商品</label>
                                    </div>
                                </div>
                                <div class="col-auto my-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input mr-2" id="showPrice" name="showPrice" value="1">
                                        <label class="custom-control-label" for="showPrice">是否顯示此商品價格</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="length">
                                        商品長度（公分）
                                    </label>
                                    <input id="length" name="length" type="text" class="form-control @error('length') is-invalid @enderror" value="{{ old('length') }}" autocomplete="off">

                                    @error('length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="width">
                                        商品寬度（公分）
                                    </label>
                                    <input id="width" name="width" type="text" class="form-control @error('width') is-invalid @enderror" value="{{ old('width') }}" autocomplete="off">

                                    @error('width')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="chamfer">
                                        商品折角（公分）
                                    </label>
                                    <input id="chamfer" name="chamfer" type="text" class="form-control @error('chamfer') is-invalid @enderror" value="{{ old('chamfer') }}" autocomplete="off">

                                    @error('chamfer')
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
                                    <label for="qty_per_pack">
                                        每件數量
                                    </label>

                                    <input id="qty_per_pack" name="qty_per_pack" type="text" class="form-control @error('qty_per_pack') is-invalid @enderror" value="{{ old('qty_per_pack') }}" autocomplete="off">

                                    @error('qty_per_pack')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">
                                        慣用單位
                                    </label>

                                    <select id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit">
                                        <option value="package" selected>包</option>
                                        <option value="kg">公斤</option>
                                        <option value="roll">捲</option>
                                    </select>

                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="intro">
                                商品簡介
                            </label>

                            <textarea id="intro" name="intro" type="text" class="form-control @error('intro') is-invalid @enderror" value="{{ old('intro') }}"></textarea>

                            @error('intro')
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
                            <label for="quantity">
                                目前庫存量
                            </label>

                            <input id="quantity" name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') ?? 0 }}">

                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="safeQuantity">
                                安全庫存量
                            </label>

                            <input id="safeQuantity" name="safeQuantity" type="text" class="form-control @error('safeQuantity') is-invalid @enderror" value="{{ old('safeQuantity') ??  0 }}">

                            @error('safeQuantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="comment">
                                備註
                            </label>

                            <textarea id="comment" name="comment" type="text" class="form-control @error('comment') is-invalid @enderror" value="{{ old('comment') }}"></textarea>

                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <product-recipes ref="productRecipes" :materials="materials" v-on:refresh-materials="refreshMaterials"></product-recipes>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認新增
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-block btn-danger">
                            返回上一頁
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

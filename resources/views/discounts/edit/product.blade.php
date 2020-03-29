@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/discounts/edit-product.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('discounts.index') }}">{{ __('Discounts') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent
    
    <div id="discounts">
		<span id="getConsumersName" style="display: none;">{{ route('consumers.showName') }}</span>
        <span id="getConsumerInfo" style="display: none;">{{ route('consumers.getInfo') }}</span>
        <span id="getDiscountsList" style="display: none;">{{ route('products.getDiscountsList', [$product->id]) }}</span>
        <span id="discountsIndex" style="display: none;">{{ route('discounts.index') }}</span>

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shownID">商品編號</label>
                            <input id="shownID" name="shownID" type="text" class="form-control" value="{{ $product->shownID }}" readonly>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="isManualID" id="ManualID" {{ ($product->isManualNamed)?'checked':'' }} disabled>
                            <label class="custom-control-label" for="ManualID">
                                <small>手動編號</small>
                            </label>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">商品名稱</label>
                            <input id="name" name="name" type="text" class="form-control mb-2" value="{{ $product->name }}" readonly>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ManualNamed" {{ ($product->isManualNamed)?'checked':'' }} disabled>
                            <label class="custom-control-label" for="ManualNamed">
                                <small>手動命名</small>
                            </label>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="internationalNum">國際條碼</label>
                            <input id="internationalNum" name="internationalNum" type="text" class="form-control" value="{{ $product->internationalNum }}" readonly>
                        </div>
                    </div>
                </div>
    
                <div class="row">

                    <div class="col-md-6 text-center">
                        {{-- 商品圖片 --}}
                        <div class="form-group row py-2">
                            <div id="preview-upload" class="col-md-12">
                                <img id="previewImg-upload" class="img-fluid rounded" src="{{ $product->showPicture() }}" style="width:80%;">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specification">商品規格</label>
                                    <input id="specification" name="specification" type="text" class="form-control" value="{{ $product->specification }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color">商品顏色或花樣</label>
                                    <input id="color" name="color" type="text" class="form-control" value="{{ $product->color ?? '無' }}" readonly>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="length">商品長度（公分）</label>
                                    <input id="length" name="length" type="text" class="form-control" value="{{ $product->length ?? '無' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="width">商品寬度（公分）</label>
                                    <input id="width" name="width" type="text" class="form-control" value="{{ $product->width ?? '無' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="chamfer">商品折角（公分）</label>
                                    <input id="chamfer" name="chamfer" type="text" class="form-control" value="{{ $product->chamfer ?? '無' }}" readonly>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="weight">商品重量（單位：兩）</label>
                            <input id="weight" name="weight" type="text" class="form-control" value="{{ $product->weight ?? '無' }}" readonly>
                        </div>
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty_per_pack">每件數量</label>
                                    <input id="qty_per_pack" name="qty_per_pack" type="text" class="form-control" value="{{ $product->qty_per_pack }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">慣用單位</label>
                                    <input id="unit" name="unit" type="text" class="form-control" value="{{ $product->showUnit() }}" readonly>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="category_id">商品類別</label>
                            <input id="category_id" name="category_id" type="text" class="form-control" value="{{ $product->category->name }}" readonly>
                        </div>
    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="totalCost">總成本價</label>
                                    <input id="totalCost" name="totalCost" type="text" class="form-control mb-2" value="{{ $product->costprice }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profit">利潤</label>
                                    <input id="profit" name="profit" type="text" class="form-control mb-2" value="{{ $product->profit }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="retailPrice">零售價</label>
                                    <input id="retailPrice" name="retailPrice" type="text" class="form-control" value="{{ $product->retailPrice }}" readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
    
            </div>
        </div>

        <product-discounts :consumers="consumers" :discounts="discounts" v-on:refresh-consumers="refreshConsumers"></product-discounts>
	</div>

@endsection

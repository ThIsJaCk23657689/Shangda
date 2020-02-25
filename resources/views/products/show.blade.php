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
			<a href="#">{{ __('Products') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

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
                            <img id="previewImg-upload" class="img-fluid rounded" src="{{ $product->showPicture() }}">
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

                    <div class="form-group">
                        <label for="intro">商品簡介</label>
                        <textarea id="intro" name="intro" type="text" class="form-control" value="{{ $product->intro }}" readonly></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity">目前庫存量</label>
                        <input id="quantity" name="quantity" type="text" class="form-control" value="{{ $product->quantity ?? 0 }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="safeQuantity">安全庫存量</label>
                        <input id="safeQuantity" name="safeQuantity" type="text" class="form-control" value="{{ $product->safeQuantity ??  0 }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">備註</label>
                        <textarea id="comment" name="comment" type="text" class="form-control" value="{{ $product->comment }}" readonly></textarea>               
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row justify-content-center">
                <div class="col-md-12">
            
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>原物料</th>
                                <th>單價</th>
                                <th>耗材比</th>
                                <th>成本價</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $recipe)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $recipe->name }}</td>
                                    <td>
                                        <input id="unitPrice_{{ $loop->iteration }}" type="text" class="form-control mr-2" value="{{ $recipe->unitPrice }}" disabled style="width:60%;display:inline-block;">
                                        <span> 元 / {{ ($recipe->unit == 1) ? '公斤' : '公噸' }}</span>
                                    </td>
                                    <td>
                                        <input id="raito_{{ $loop->iteration }}" type="text" class="form-control" value="{{ $recipe->pivot->ratio }}" disabled>
                                    </td>
                                    <td>
                                        <input id="subcost_{{ $loop->iteration }}" type="text" class="form-control" value="{{ $recipe->pivot->subcost }}" disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                    <hr>
            
                    <div class="row">
            
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="totalCost">總成本價</label>
                                <input id="totalCost" name="totalCost" type="text" class="form-control mb-2" value="{{ $product->costprice }}" readonly>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="profit">
                                    <span class="text-danger mr-2">*</span>利潤
                                </label>
            
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
            
            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('products.index') }}" class="btn btn-block btn-danger">
                        返回商品首頁
                    </a>
                </div>
            </div>
        </div>
    </div>
	
@endsection

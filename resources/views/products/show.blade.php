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
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div id="preview-upload" class="offset-md-6 col-md-6">
                            <img id="previewImg-upload" class="img-fluid rounded" src="{{ $product->showPicture() }}">
                        </div>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">
                            商品名稱
                        </label>
            
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" class="form-control" value="{{ $product->name }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="internationalNum" class="col-md-3 col-form-label text-md-right">國際條碼</label>
            
                        <div class="col-md-6">
                            <input id="internationalNum" name="internationalNum" type="text" class="form-control" value="{{ $product->internationalNum }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="intro" class="col-md-3 col-form-label text-md-right">商品簡介</label>
            
                        <div class="col-md-6">
                            <input id="intro" name="intro" type="text" class="form-control" value="{{ $product->intro }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="shortName" class="col-md-3 col-form-label text-md-right">商品容量</label>
            
                        <div class="col-md-6">
                            <input id="shortName" name="shortName" type="text" class="form-control" value="{{ $product->shortName }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="specification" class="col-md-3 col-form-label text-md-right">商品規格</label>
            
                        <div class="col-md-6">
                            <input id="specification" name="specification" type="text" class="form-control" value="{{ $product->specification }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="unit" class="col-md-3 col-form-label text-md-right">慣用單位</label>
                        
                        <div class="col-md-6">
                            <input id="unit" name="unit" type="text" class="form-control" value="{{ $product->showUnit() }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="quantity" class="offset-md-3 col-md-3 col-form-label text-md-right">目前庫存量</label>
            
                        <div class="col-md-6">
                            <input id="quantity" name="quantity" type="text" class="form-control" value="{{ $product->quantity ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>
            
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="safeQuantity" class="col-md-3 col-form-label text-md-right">安全庫存量</label>
            
                        <div class="col-md-6">
                            <input id="safeQuantity" name="safeQuantity" type="text" class="form-control" value="{{ $product->safeQuantity ??  0 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="comment" class="offset-md-3 col-md-3 col-form-label text-md-right">
                            備註
                        </label>
            
                        <div class="col-md-6">
                            <input id="comment" type="text" class="form-control" name="comment" value="{{ $product->comment }}" disabled>
                        </div>                    
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="category_id" class="col-md-3 col-form-label text-md-right">
                            商品類別
                        </label>
            
                        <div class="col-md-6">
                            <select id="category_id" class="form-control" name="category_id" disabled>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($product->category_id == $category->id)?'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>                    
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row justify-content-center">
                <div class="col-md-12">
                    
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><label for="fundamentalPrice">基礎價格</label></th>
                                @foreach ($basicMaterials as $basicMaterial)
                                    <th>
                                        <label for="materialCoefficient{{ $loop->iteration }}">
                                            {{ $basicMaterial->name }}比重<br>
                                            價格：<span id="material_{{ $loop->iteration }}">{{ $basicMaterial->price }}</span>
                                        </label>
                                    </th>
                                @endforeach
                                <th><label for="retailPrice">零售價</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="fundamentalPrice" name="fundamentalPrice" type="text" class="form-control" value="{{ $product->fundamentalPrice ?? 0 }}" disabled>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="materialCoefficient1" name="materialCoefficient1" type="text" class="form-control" value="{{ $product->materialCoefficient1 ?? 0 }}" disabled>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="materialCoefficient2" name="materialCoefficient2" type="text" class="form-control" value="{{ $product->materialCoefficient2 ?? 0 }}" disabled>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="materialCoefficient3" name="materialCoefficient3" type="text" class="form-control" value="{{ $product->materialCoefficient3 ?? 0 }}" disabled>
            
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="materialCoefficient4" name="materialCoefficient4" type="text" class="form-control" value="{{ $product->materialCoefficient4 ?? 0 }}" disabled>
            
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="materialCoefficient5" name="materialCoefficient5" type="text" class="form-control" value="{{ $product->materialCoefficient5 ?? 0 }}" disabled>
            
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="retailPrice" name="retailPrice" type="text" class="form-control" value="{{ $product->retailPrice ?? 0 }}" disabled>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            
                </div>
            </div>
            
            <hr>
            
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

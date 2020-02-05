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
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-12">
            <form id="product_create_form" method="POST" action="{{ route('products.update', [$product->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        {{-- 商品圖片 --}}
                        <div class="form-group row">
                            <div id="preview-upload" class="offset-md-6 col-md-6">
                                <img id="previewImg-upload" class="img-fluid rounded" src="{{ $product->showPicture() }}">
                            </div>
                        </div>
                        <div class="form-group row my-4">
                            <label for="picture" class="col-md-6 col-form-label text-md-right">上傳圖片(支援JPG、PNG)</label>
    
                            <div class="col-md-6">
                                <input id="picture" name="picture" type="file" class="form-control-file" accept="image/jpeg,image/png">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>商品名稱</label>
    
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $product->name }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="internationalNum" class="col-md-3 col-form-label text-md-right">國際條碼</label>
    
                            <div class="col-md-6">
                                <input id="internationalNum" name="internationalNum" type="text" class="form-control @error('internationalNum') is-invalid @enderror" value="{{ old('internationalNum') ?? $product->internationalNum }}" autocomplete="internationalNum">
                                
                                @error('internationalNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="intro" class="col-md-3 col-form-label text-md-right">商品簡介</label>
    
                            <div class="col-md-6">
                                <input id="intro" name="intro" type="text" class="form-control @error('intro') is-invalid @enderror" value="{{ old('intro') ?? $product->intro }}" autocomplete="intro">
                                
                                @error('intro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shortName" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>商品容量</label>
    
                            <div class="col-md-6">
                                <input id="shortName" name="shortName" type="text" class="form-control @error('shortName') is-invalid @enderror" value="{{ old('shortName') ?? $product->shortName  }}" required autocomplete="shortName" placeholder="一兩、半斤...等。">
                                
                                @error('shortName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specification" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>商品規格</label>
    
                            <div class="col-md-6">
                                <input id="specification" name="specification" type="text" class="form-control @error('specification') is-invalid @enderror" value="{{ old('specification') ?? $product->specification }}" required autocomplete="specification" placeholder="88cm * 25cm ...等。">
                                
                                @error('specification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>慣用單位</label>
                            
                            <div class="col-md-6">
                                <select id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit" required>
                                    <option value="g" {{ ($product->unit == "g")?'selected':'' }}>公噸</option>
                                    <option value="kg"  {{ ($product->unit == "kg")?'selected':'' }}>公斤</option>
                                    <option value="mt"  {{ ($product->unit == "mt")?'selected':'' }}>公噸</option>
                                </select>

                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="quantity" class="offset-md-3 col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>目前庫存量</label>
    
                            <div class="col-md-6">
                                <input id="quantity" name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') ?? $product->quantity }}" required autocomplete="quantity">
                                
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="safeQuantity" class="col-md-3 col-form-label text-md-right"><span class="text-danger">*</span>安全庫存量</label>
    
                            <div class="col-md-6">
                                <input id="safeQuantity" name="safeQuantity" type="text" class="form-control @error('safeQuantity') is-invalid @enderror" value="{{ old('safeQuantity') ??  $product->safeQuantity }}" required autocomplete="safeQuantity">
                                
                                @error('safeQuantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') ?? $product->comment }}" autocomplete="comment">
                                
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                    
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="category_id" class="col-md-3 col-form-label text-md-right">
                                商品類別
                            </label>
        
                            <div class="col-md-6">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($product->category_id == $category->id)?'selected':'' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                    <th><label for="fundamentalPrice"><span class="text-danger">*</span>基礎價格</label></th>
                                    @foreach ($basicMaterials as $basicMaterial)
                                        <th>
                                            <label for="materialCoefficient{{ $loop->iteration }}">
                                                <span class="text-danger">*</span>原物料比重{{ $loop->iteration }}<br>
                                                價格：<span id="{{ $basicMaterial->name }}">{{ $basicMaterial->price }}</span>
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
                                                <input id="fundamentalPrice" name="fundamentalPrice" type="text" class="form-control @error('fundamentalPrice') is-invalid @enderror" value="{{ old('fundamentalPrice') ?? $product->fundamentalPrice }}" required autocomplete="fundamentalPrice">
                                                @error('fundamentalPrice')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="materialCoefficient1" name="materialCoefficient1" type="text" class="form-control @error('materialCoefficient1') is-invalid @enderror" value="{{ old('materialCoefficient1') ?? $product->materialCoefficient1 }}" required autocomplete="materialCoefficient1">
                                                @error('materialCoefficient1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="materialCoefficient2" name="materialCoefficient2" type="text" class="form-control @error('materialCoefficient2') is-invalid @enderror" value="{{ old('materialCoefficient2') ?? $product->materialCoefficient2 }}" required autocomplete="materialCoefficient2">
                                                @error('materialCoefficient2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="materialCoefficient3" name="materialCoefficient3" type="text" class="form-control @error('materialCoefficient3') is-invalid @enderror" value="{{ old('materialCoefficient3') ?? $product->materialCoefficient3 }}" required autocomplete="materialCoefficient3">
                                                @error('materialCoefficient3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="materialCoefficient4" name="materialCoefficient4" type="text" class="form-control @error('materialCoefficient4') is-invalid @enderror" value="{{ old('materialCoefficient4') ?? $product->materialCoefficient4 }}" required autocomplete="materialCoefficient4">
                                                @error('materialCoefficient4')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="materialCoefficient5" name="materialCoefficient5" type="text" class="form-control @error('materialCoefficient5') is-invalid @enderror" value="{{ old('materialCoefficient5') ?? $product->materialCoefficient5}}" required autocomplete="materialCoefficient5">
                                                @error('materialCoefficient5')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="retailPrice" name="retailPrice" type="text" class="form-control" value="{{ old('retailPrice') ?? $product->retailPrice }}" disabled>
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
                        <button type="submit" class="btn btn-block btn-primary">
                            確認修改
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
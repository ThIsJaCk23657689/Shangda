@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Categories') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    商品分類名稱
                </label>
            
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" disabled>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="intro" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    商品類別簡介
                </label>
            
                <div class="col-md-6">
                    <input id="intro" type="text" class="form-control" name="intro" value="{{ $category->intro }}" disabled>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>此類別的旗下商品</h3>
                </div>

                <div class="col-md-12">
                    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>圖片</th>
                                <th>名稱</th>
                                <th>零售價</th>
                                <th>目前存貨量</th>
                                <th>單位</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->productsWithTrashed() as $product)
                                <tr class="{{ $product->trashed()?'bg-warning':'' }}">
                                    <td>{{ $product->id }}</td>
                                    <td style="width:10%">
                                        <img class="img-fluid rounded" src="{{ $product->showPicture() }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->retailPrice }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->showUnit() }}</td>
                                    <td>
                                        <a href="{{ route('products.show', [$product->id]) }}" class="btn btn-md btn-info">
                                            <i class="fas fa-info-circle"></i>
                                            查看
                                        </a>
                                        <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-md btn-success">
                                            <i class="fas fa-edit"></i>
                                            編輯
                                        </a>
                                        @if($product->trashed())
                                            <a href="#" class="btn btn-md btn-light" onclick="
                                                event.preventDefault();
                                                ans = confirm('確定要上架此商品嗎?');
                                                if(ans){
                                                    $('#deleteform-{{ $product->id }}').submit();
                                                }
                                            ">
                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                                上架
                                            </a>

                                            <form id="deleteform-{{ $product->id }}" action="{{ route('products.destroy', [$product->id]) }}" method="POST" style="displat: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-md btn-danger" onclick="
                                                event.preventDefault();
                                                ans = confirm('確定要下架此商品嗎?');
                                                if(ans){
                                                    $('#deleteform-{{ $product->id }}').submit();
                                                }
                                            ">
                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                                下架
                                            </a>
                                        @endif
    
                                        <form id="deleteform-{{ $product->id }}" action="{{ route('products.destroy', [$product->id]) }}" method="POST" style="displat: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>	
                            @endforeach
                        </tbody>
                    </table>
            
                </div>
            </div>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('categories.index') }}" class="btn btn-block btn-danger">
                        返回商品類別首頁
                    </a>
                </div>
            </div>
        </div>
    </div>
	
@endsection

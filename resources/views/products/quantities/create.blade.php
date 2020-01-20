@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/products/quantities/create.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Product Quantities Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Product Quantities') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
    @endcomponent
    
    <div id="ProductQuantities">
        {{-- <span id="getSuppliersName" style="display: none;">{{ route('suppliers.showName') }}</span> --}}
		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductsInfo" style="display: none;">{{ route('products.getInfo') }}</span>

        <span id="createSupplier" style="display: none;">{{ route('products.quantities.store') }}</span>
        <span id="getProductQuantitiesIndex" style="display: none;">{{ route('products.quantities.index') }}</span>
		
		<product-quantities-create-form :products="products" :current_product="current_product" :materials="materials" v-on:get-product-data="getProductData"></product-quantities-create-form>
	</div>

    
	
@endsection

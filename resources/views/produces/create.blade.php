@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/produces/create.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Produces') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
    @endcomponent
    
    <div id="Produces">
        {{-- <span id="getSuppliersName" style="display: none;">{{ route('suppliers.showName') }}</span> --}}
		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductsInfo" style="display: none;">{{ route('products.getInfo') }}</span>

		<span id="getMeterialsName" style="display: none;">{{ route('materials.showName') }}</span>
		<span id="getMeterialInfo" style="display: none;">{{ route('materials.getInfo') }}</span>

        <span id="createProduce" style="display: none;">{{ route('produces.store') }}</span>
		<span id="getProducesIndex" style="display: none;">{{ route('produces.index') }}</span>
		
		
		
		<produces-create-form :products="products" :current_product="current_product" :materials="materials" v-on:get-product-data="getProductData"></produces-create-form>
	</div>
@endsection

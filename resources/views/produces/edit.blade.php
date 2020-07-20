@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/produces/edit.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('produces.index') }}">{{ __('Produces') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent
    
    <div id="Produces">
        {{-- <span id="getSuppliersName" style="display: none;">{{ route('suppliers.showName') }}</span> --}}
		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductsInfo" style="display: none;">{{ route('products.getInfo') }}</span>

		<span id="getMeterialsName" style="display: none;">{{ route('materials.showName') }}</span>
		<span id="getMeterialInfo" style="display: none;">{{ route('materials.getInfo') }}</span>

        <span id="updateProduce" style="display: none;">{{ route('produces.update', [$produce->id]) }}</span>
        <span id="updateProduceDetail" style="display: none;">{{ route('produces.details.update') }}</span>

        <span id="getProducesIndex" style="display: none;">{{ route('produces.index') }}</span>
		<span id="getProducesData" style="display: none;">{{ route('produces.getOne', [$produce->id]) }}</span>

		<produces-update-form 
			ref="ProduceUpdateForm" 
			:products="products" 
            :materials="materials" 
            :produce="produce"
			v-on:refresh-products="refreshProducts"
			v-on:refresh-materials="refreshMaterials">
		</produces-update-form>
	</div>
@endsection

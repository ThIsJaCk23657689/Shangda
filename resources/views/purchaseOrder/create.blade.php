@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/purchase.js') }}" defer></script>
@endpush   

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Purchase Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

	<div id="purchase">
		<span id="getSuppliersName" style="display: none;">{{ route('suppliers.showName') }}</span>
		<span id="getSupplierInfo" style="display: none;">{{ route('suppliers.getInfo') }}</span>

		<span id="getMeterialsName" style="display: none;">{{ route('materials.showName') }}</span>
		<span id="getMeterialInfo" style="display: none;">{{ route('materials.getInfo') }}</span>

		<span id="createSupplier" style="display: none;">{{ route('suppliers.store') }}</span>
		<span id="createPurchaseOrder" style="display: none;">{{ route('purchase.store') }}</span>

		<span id="createPurchaseOrderDetail" style="display: none;">{{ route('purchase.details.store') }}</span>
		<span id="getPurchaseOrderIndex" style="display: none;">{{ route('purchase.index') }}</span>
		
		<purchase-create-form :suppliers="suppliers" :current_supplier="current_supplier" :materials="materials" v-on:get-supplier-data="getSupplierData" returnURL="{{ route('purchase.index') }}"></purchase-create-form>
	</div>
	
@endsection

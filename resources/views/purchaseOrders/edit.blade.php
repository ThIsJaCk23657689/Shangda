@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/purchase/edit.js') }}" defer></script>
@endpush   

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('purchase.index') }}">{{ __('Purchase Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

	<div id="purchase">
		<span id="getSuppliersName" style="display: none;">{{ route('suppliers.showName') }}</span>
		<span id="getSupplierInfo" style="display: none;">{{ route('suppliers.getInfo') }}</span>

		<span id="getMeterialsName" style="display: none;">{{ route('materials.showName') }}</span>
		<span id="getMeterialInfo" style="display: none;">{{ route('materials.getInfo') }}</span>

        <span id="createSupplier" style="display: none;">{{ route('suppliers.store') }}</span>
        <span id="getPurchaseOrderInfo" style="display: none;">{{ route('purchase.getOne', [$purchaseID]) }}</span>

		<span id="updatePurchaseOrder" style="display: none;">{{ route('purchase.update', [$purchaseID]) }}</span>
		<span id="updatePurchaseOrderDetail" style="display: none;">{{ route('purchase.details.update') }}</span>
		
        <purchase-update-form 
            ref="purchaseform" 
            :suppliers="suppliers" 
            :current_supplier="current_supplier" 
            :materials="materials" 
            :purchase="purchase"
            v-on:get-supplier-data="getSupplierData" 
            return-url="{{ route('purchase.index') }}">
        </purchase-update-form>
	</div>
	
@endsection

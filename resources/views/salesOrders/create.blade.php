@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/sales/create.js') }}" defer></script>
@endpush   

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Sales Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

	<div id="sales">
		<span id="getConsumersName" style="display: none;">{{ route('consumers.showName') }}</span>
		<span id="getConsumerInfo" style="display: none;">{{ route('consumers.getInfo') }}</span>

		<span id="getProductssName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductInfo" style="display: none;">{{ route('products.getInfo') }}</span>

		<span id="createConsumer" style="display: none;">{{ route('consumers.store') }}</span>
		<span id="createSalesOrder" style="display: none;">{{ route('sales.store') }}</span>

		<span id="createSalesOrderDetail" style="display: none;">{{ route('sales.details.store') }}</span>
		<span id="getSalesOrderIndex" style="display: none;">{{ route('sales.index') }}</span>

		<span id="getAuthName" style="display: none;">{{ Auth::user()->name }}</span>
		<span id="getSalesOrderShownID" style="display: none;">{{ $new_shownID }}</span>
		
		<sales-create-form :consumers="consumers" :current_comsumer="current_consumer" :products="products" v-on:get-consumer-data="getConsumerData" returnURL="{{ route('sales.index') }}"></sales-create-form>
	</div>
	
@endsection

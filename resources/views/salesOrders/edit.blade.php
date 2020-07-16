@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/sales/edit.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Sales Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

	<div id="sales">
        <span id="getConsumersName" style="display: none;">{{ route('consumers.showName') }}</span>
		<span id="getConsumerInfo" style="display: none;">{{ route('consumers.getInfo') }}</span>

		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductInfo" style="display: none;">{{ route('products.getInfo') }}</span>

		<span id="createConsumer" style="display: none;">{{ route('consumers.store') }}</span>


		<span id="getAuthName" style="display: none;">{{ Auth::user()->name }}</span>

        <span id="getSalesOrderInfo" style="display: none;">{{ route('sales.getOne', [$salesOrder->id]) }}</span>

		<span id="updateSalesOrder" style="display: none;">{{ route('sales.update', [$salesOrder->id]) }}</span>
		<span id="updateSalesOrderDetail" style="display: none;">{{ route('sales.details.update') }}</span>

        <sales-update-form
            ref="salesOrderform"
            :consumers="consumers"
            :current_consumer="current_consumer"
            :products="products"
            :sales-order="salesOrder"
            v-on:get-consumer-data="getConsumerData"
            return-url="{{ route('sales.index') }}">
        </sales-update-form>
	</div>

@endsection

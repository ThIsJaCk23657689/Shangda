@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/orders/returns/edit.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Return Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

	<div id="return">
        <span id="getConsumersName" style="display: none;">{{ route('consumers.showName') }}</span>
		<span id="getConsumerInfo" style="display: none;">{{ route('consumers.getInfo') }}</span>

		<span id="getProductsName" style="display: none;">{{ route('products.showName') }}</span>
		<span id="getProductInfo" style="display: none;">{{ route('products.getInfo') }}</span>

		<span id="createConsumer" style="display: none;">{{ route('consumers.store') }}</span>


		<span id="getAuthName" style="display: none;">{{ Auth::user()->name }}</span>

        <span id="getReturnOrderInfo" style="display: none;">{{ route('return.getOne', [$returnID]) }}</span>

		<span id="updateReturnOrder" style="display: none;">{{ route('return.update', [$returnID]) }}</span>
		<span id="updateReturnOrderDetail" style="display: none;">{{ route('sales.details.update') }}</span>

        <return-update-form
            ref="returnOrderform"
            :consumers="consumers"
            :current_consumer="current_consumer"
            :products="products"
            :return-order="returnOrder"
            v-on:get-consumer-data="getConsumerData"
            return-url="{{ route('return.index') }}">
        </return-update-form>
	</div>

@endsection

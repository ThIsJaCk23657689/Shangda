@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
	<script src="{{ asset('js/consumers/index.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('consumers.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增顧客
			</a>
		</div>
	</div>

	<div id="consumer">
		<span id="ConsumersGetList" class="d-none">{{ route('consumers.getList') }}</span>

		<consumers-table 
			:consumers="consumers" 
			:rows-per-page="rowsPerPage" 
			:page-num="pageNum" 
			:total-page="totalPage" 
			v-on:update-consumer="updateConsumer"
			v-on:change-status="changeStatus" 
			v-on:change-order="changeOrder" 
			v-on:change-category="changeCategory" 
			v-on:change-keywords-type="changeKeywordsType">
		</consumers-table>
	</div>

@endsection

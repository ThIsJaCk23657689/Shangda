@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/materials/basic/index.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Basic Materials') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div id="basicmaterial">
		<basic-materials-table :basic_materials="basic_materials"></basic-materials-table>

		<span id="getBasicMaterialsList" style="display:none;">{{ route('material.basic.getList') }}</span>
		<span id="getBasicMaterialsURL" style="display:none;">{{ route('material.basic.index') }}</span>
	</div>
	
@endsection

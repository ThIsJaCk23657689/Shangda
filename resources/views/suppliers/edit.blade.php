@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/suppliers/edit.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent
    
    <div id="supplier">
        <span id="SuppliersIndexURL" class="d-none">{{ route('suppliers.index') }}</span>
        <span id="SuppliersGetOneURL" class="d-none">{{ route('suppliers.getOne', [$supplier->id]) }}</span>
        <span id="SuppliersUpdateURL" class="d-none">{{ route('suppliers.update', [$supplier->id]) }}</span>

        <supplier-update-form :supplier="supplier"></supplier-update-form>
    </div>

@endsection

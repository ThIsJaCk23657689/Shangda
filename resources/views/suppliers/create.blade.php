@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/suppliers/create.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div id="supplier">
        <span id="SuppliersIndexURL" class="d-none">{{ route('suppliers.index') }}</span>
        <span id="SuppliersStoreURL" class="d-none">{{ route('suppliers.store') }}</span>

        <supplier-create-form></supplier-create-form>
    </div>
	
@endsection

@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/information/edit.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('System Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('information.edit', [1]) }}">{{ __('Information Image') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent

    <div id="information">
        <span id="InformationGetOneURL" class="d-none">{{ route('information.getOne', [1]) }}</span>
        <span id="InformationUpdateURL" class="d-none">{{ route('information.update', [1]) }}</span>

        <information-update-form :information='information'></information-update-form>
    </div>

@endsection

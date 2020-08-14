@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/announcements/create.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('System Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('announcements.index') }}">{{ __('News') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
    @endcomponent

    <div id="announcement">
        <span id="AnnouncementsIndexURL" class="d-none">{{ route('announcements.index') }}</span>
		<span id="AnnouncementsStoreURL" class="d-none">{{ route('announcements.store') }}</span>
		<span id="AnnouncementsDefaultImage" class="d-none">{{ asset('images/announcements/cover_images/default.png') }}</span>

        <announcement-create-form></announcement-create-form>
    </div>

@endsection

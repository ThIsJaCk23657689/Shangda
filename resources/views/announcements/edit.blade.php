@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/announcements/edit.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('System Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('announcements.index') }}">{{ __('News') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent
    
    <div id="announcement">
        <span id="AnnouncementsIndexURL" class="d-none">{{ route('announcements.index') }}</span>
        <span id="AnnouncementsGetOneURL" class="d-none">{{ route('announcements.getOne', [$announcement->id]) }}</span>
        <span id="AnnouncementsUpdateURL" class="d-none">{{ route('announcements.update', [$announcement->id]) }}</span>

        <announcement-update-form :announcement='announcement'></announcement-update-form>
    </div>

@endsection

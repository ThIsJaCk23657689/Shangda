@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/consumers/edit.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
    @endcomponent

    <div id="consumer">
        <span id="ConsumersTaxIDURL" class="d-none">{{ route('consumers.getData') }}</span>
        <span id="ConsumerGetOneURL" class="d-none">{{ route('consumers.getOne', [$consumer->id]) }}</span>
        <span id="ConsumersIndexURL" class="d-none">{{ route('consumers.index') }}</span>
        <span id="ConsumersUpdateURL" class="d-none">{{ route('consumers.update', [$consumer->id]) }}</span>

        <div class="row justify-content-center">
            <div class="col-md-10">

                @if($consumer->account_type == 0)
                    <individual-consumer-update-form :consumer="consumer" :uploadimg="'{{ $consumer->showPicture() }}'"></individual-consumer-update-form>
                @else
                    <company-consumer-update-form :consumer="consumer" :uploadimg="'{{ $consumer->showPicture() }}'"></company-consumer-update-form>
                @endif

            </div>
        </div>
    </div>

@endsection

@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/consumers/reset.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/reset.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    
    <section id="auth" class="header">
        <div class="bg-image"></div>
        <div class="bg-gray"></div>

        <span id="ConsumerPasswordEmailURL" class="d-none">{{ route('consumers.password.email') }}</span>

        <request-link-form></request-link-form>
    </section>

@endsection

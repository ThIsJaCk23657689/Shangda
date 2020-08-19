@extends('layouts.frontend.master')

@push('CustomJS')
    <script src="{{ asset('js/frontend/consumers/login.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{  asset('css/frontend/consumers/login.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    
    <section id="auth" class="header">
        <div class="bg-image"></div>
        <div class="bg-gray"></div>

        <span id="ConsumerLoginURL" class="d-none">{{ route('consumers.login') }}</span>
        <span id="IntendedURL" class="d-none">{{ session('url.intended') }}</span>
        <span id="ForgetPasswordURL" class="d-none">{{ route('consumers.password.request') }}</span>

        <login-form></login-form>
    </section>

@endsection

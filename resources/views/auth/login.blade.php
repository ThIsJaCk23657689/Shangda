@extends('layouts.backend.auth')

@push('CustomJS')
    <script src="{{ asset('js/auth/login.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div id="auth" class="container-fluid">
    <div class="auth-container">

        <login-form></login-form>

        <span id="LoginURL" class="d-none">{{ route('login') }}</span>
        <span id="IntendedURL" class="d-none">{{ session('url.intended') }}</span>
        <span id="ForgetPasswordURL" class="d-none">{{ route('password.request') }}</span>
    </div>
</div>
@endsection

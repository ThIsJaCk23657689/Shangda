@extends('layouts.backend.auth')

@push('CustomJS')
    <script src="{{ asset('js/auth/email.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div id="auth" class="container-fluid">
    <div class="auth-container">
        <span id="PasswordEmailURL" class="d-none">{{ route('password.email') }}</span>

        <request-link-form></request-link-form>
    </div>
</div>
@endsection

@extends('layouts.backend.auth')

@push('CustomJS')
    <script src="{{ asset('js/auth/reset.js') }}" defer></script>
@endpush

@push('CustomCSS')
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div id="auth" class="container-fluid">
    <div class="auth-container">
        <span id="PasswordUpdateURL" class="d-none">{{ route('password.update') }}</span>
        <span id="EmailForInit" class="d-none">{{ $email ?? old('email') }}</span>
        <span id="PasswordResetToken" class="d-none">{{ $token }}</span>

        <reset-password-form></reset-password-form>
    </div>
</div>
@endsection

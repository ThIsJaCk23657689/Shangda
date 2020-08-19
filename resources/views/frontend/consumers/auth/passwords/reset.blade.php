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

        <span id="ConsumerPasswordUpdateURL" class="d-none">{{ route('consumers.password.update') }}</span>
        <span id="EmailForInit" class="d-none">{{ $email ?? old('email') }}</span>
        <span id="PasswordResetToken" class="d-none">{{ $token }}</span>

        <reset-password-form></reset-password-form>
    </section>

@endsection

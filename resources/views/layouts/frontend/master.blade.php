<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __(config('app.name')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/welcome/app.js') }}" defer></script>
    <script src="{{ asset('js/welcome/plugins.js') }}" defer></script>
    <script src="{{ asset('js/welcome/slides.js') }}" defer></script>

    <!-- Custom scripts for all pages-->
    @stack('CustomJS')

    <!-- Styles -->
    <link href="{{ asset('css/welcome/slides.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type='text/css'>
    
    <!-- Custom styles for this template-->
    @stack('CustomCSS')
</head>
<body class="slides chain simplifiedMobile scroll animated">

    @include('partials.frontend.welcome.svg')

    {{-- @include('partials.frontend.welcome.scrollbar') --}}

    @include('partials.frontend.welcome.navbar')

	@include('partials.frontend.welcome.sidebar')

	<div id="content-wrapper">
        <div id="app"></div>

		<div class="container-fluid wrapper">
			@yield('content')
		</div>

		@include('partials.frontend.footer')
	</div>

</body>
</html>
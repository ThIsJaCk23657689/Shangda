@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/salary/index.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item active">薪資管理</li>
    @endcomponent

    <div id="salary-app">
        <salary-index-page></salary-index-page>
    </div>
@endsection

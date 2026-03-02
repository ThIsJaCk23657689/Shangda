@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/employees/index.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item active">員工資料</li>
    @endcomponent

    <div id="employee-app">
        <employee-index-page></employee-index-page>
    </div>
@endsection

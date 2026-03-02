@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/employees/show.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('employees.index') }}">員工資料</a>
        </li>
        <li class="breadcrumb-item active">員工詳情</li>
    @endcomponent

    <div id="employee-app">
        <employee-show-page :employee-id="{{ (int) $employeeId }}"></employee-show-page>
    </div>
@endsection

@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/attendance/index.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('employees.index') }}">員工資料</a>
        </li>
        <li class="breadcrumb-item active">出勤記錄</li>
    @endcomponent

    <div id="attendance-app">
        <attendance-index-page :employee-id="{{ (int) $employeeId }}"></attendance-index-page>
    </div>
@endsection

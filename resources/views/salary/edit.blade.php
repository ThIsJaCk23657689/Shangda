@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/salary/edit.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/backend/salary">薪資管理</a>
        </li>
        <li class="breadcrumb-item active">薪資單</li>
    @endcomponent

    <div id="salary-app">
        <salary-edit-page :employee-id="{{ (int) $employeeId }}"></salary-edit-page>
    </div>
@endsection

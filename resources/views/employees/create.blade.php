@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('vendor/jQuery-TWzipcode-master/jquery.twzipcode.min.js') }}" defer></script>
    <script src="{{ asset('js/employees/create.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('employees.index') }}">員工資料</a>
        </li>
        <li class="breadcrumb-item active">新增員工</li>
    @endcomponent

    <div id="employee-app">
        <employee-form-page mode="create"></employee-form-page>
    </div>
@endsection

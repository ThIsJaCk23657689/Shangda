@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/salary/calculator.js') }}" defer></script>
@endpush

@section('content')

    @component('components.breadcrumbs')
        <li class="breadcrumb-item">
            <a href="#">{{ __('People Management') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('Salary Calculator') }}</li>
    @endcomponent

    <div id="salary-calculator-app">
        <salary-calculator></salary-calculator>
    </div>

@endsection


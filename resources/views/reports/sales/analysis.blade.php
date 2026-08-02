@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/sales/analysis.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item active">銷售分析</li>
    @endcomponent

    <div id="sales-analysis-app">
        <sales-analysis :urls='@json($urls)'></sales-analysis>
    </div>
@endsection

@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/reports/sales/customer-detail.js') }}" defer></script>
@endpush

@section('content')
    @component('components.breadcrumbs')
        <li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Sales Report') }}</li>
        <li class="breadcrumb-item active">顧客銷售明細</li>
    @endcomponent

    <div id="customer-sales-report">
        <span id="customerSalesDataUrl" class="d-none">{{ route('reports.sales.customer_detail.data') }}</span>
        <span id="customerSalesExportUrl" class="d-none">{{ route('reports.sales.customer_detail.export') }}</span>
        <script id="customerSalesConsumers" type="application/json">@json($consumers)</script>

        <customer-sales-detail
            :consumers="consumers"
            :data-url="dataUrl"
            :export-url="exportUrl">
        </customer-sales-detail>
    </div>
@endsection

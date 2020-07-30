@extends('layouts.backend.master')

@push('CustomJS')

@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">{{ __('Report') }}</li>
        <li class="breadcrumb-item">{{ __('Account Report') }}</li>
        <li class="breadcrumb-item active">{{ __('Accounts Receivable Report') }}</li>
    @endcomponent

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table mr-2"></i>應收帳款報表
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>客戶編號</th>
                            <th>客戶名稱</th>
                            <th>聯絡窗口</th>
                            <th>連絡電話</th>
                            <th>公司地址</th>
                            <th>應付總額</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->name }}</td>
                                <td>{{ $report->operator_name ?? $report->principal ?? '無' }}</td>
                                <td>{{ $report->operator_tel ?? $report->phone ?? $report->tel ?? '無' }}</td>
                                <td>{{ $report->showAddress }}</td>
                                <td>{{ $report->totalPrice ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

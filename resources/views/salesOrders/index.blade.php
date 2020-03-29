@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
	{{-- <script src="{{ asset('js/orders/sale/index.js') }}" defer></script> --}}
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Sales Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('sales.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus mr-2"></i>
                新增銷貨單
            </a>
        </div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			銷貨單資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>顧客名稱</th>
                            <th>總銷售額(含稅)</th>
							<th>預期付款日</th>
							<th>預期出貨日</th>
							<th>建單日期</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($salesOrders as $salesOrder)
							<tr>
								<td>{{ $salesOrder->consumer->name }}</td>
								<td>{{ $salesOrder->totalTaxPrice }}</td>
								<td>{{ $salesOrder->expectPay_at->toDateString() }}</td>
								<td>{{ $salesOrder->expectDeliver_at->toDateString() }}</td>
								<td>{{ $salesOrder->created_at->toDateString() }}</td>
								<td>
									<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#ReceivedModal">
										<i class="fas fa-truck-loading"></i>
										到貨
									</button>
									@include('partials.backend.modals.received')

									<a href="#" class="btn btn-md btn-primary" onclick="
										event.preventDefault();
										ans = confirm('確認此進貨單已經完成付款？');
										if(ans){
											$('#paidform-{{ $salesOrder->id }}').submit();
										}
									">
										<i class="fas fa-hand-holding-usd"></i>
										付款
									</a>
									<form id="paidform-{{ $salesOrder->id }}" action="{{ route('sales.paid', [$salesOrder->id]) }}" method="POST" style="display: none;">
										@csrf
										@method('PATCH')
									</form>

									<a href="{{ route('sales.show', [$salesOrder->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									<a href="{{ route('sales.edit', [$salesOrder->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();
										ans = confirm('確定要刪除此廠商嗎?');
										if(ans){
											$('#deleteform-{{ $salesOrder->id }}').submit();
										}
									">
										<i class="far fa-trash-alt"></i>
										刪除
									</a>
									<form id="deleteform-{{ $salesOrder->id }}" action="{{ route('sales.destroy', [$salesOrder->id]) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
								</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted"> {{ __('Last Updated') }} {{ $lastUpdate??'無' }}</div>
	</div>
	
@endsection

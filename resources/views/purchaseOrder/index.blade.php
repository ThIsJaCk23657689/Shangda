@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
	<script src="{{ asset('js/orders/purchase/index.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Purchase Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('purchase.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增進貨單
            </a>
        </div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			進貨單資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>供應商名稱</th>
                            <th>總價(元)</th>
							<th>預期到貨日</th>
							<th>目前付款狀況</th>
							<th>目前交貨狀況</th>
							<th>建單日期</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($purchaseOrders as $purchaseOrder)
							<tr>
								<td>{{ $purchaseOrder->supplier->name }}</td>
								<td>{{ $purchaseOrder->totalPrice }}</td>
								<td>{{ $purchaseOrder->expectReceived_at->toDateString() }}</td>
								<td>{{ $purchaseOrder->showPaidStatus() }}</td>
								<td>{{ $purchaseOrder->showReceivedStatus() }}</td>
								<td>{{ $purchaseOrder->created_at->toDateString() }}</td>
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
											$('#paidform-{{ $purchaseOrder->id }}').submit();
										}
									">
										<i class="fas fa-hand-holding-usd"></i>
										付款
									</a>
									<form id="paidform-{{ $purchaseOrder->id }}" action="{{ route('purchase.paid', [$purchaseOrder->id]) }}" method="POST" style="display: none;">
										@csrf
										@method('PATCH')
									</form>

									<a href="{{ route('purchase.show', [$purchaseOrder->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									<a href="{{ route('purchase.edit', [$purchaseOrder->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();
										ans = confirm('確定要刪除此廠商嗎?');
										if(ans){
											$('#deleteform-{{ $purchaseOrder->id }}').submit();
										}
									">
										<i class="far fa-trash-alt"></i>
										刪除
									</a>
									<form id="deleteform-{{ $purchaseOrder->id }}" action="{{ route('purchase.destroy', [$purchaseOrder->id]) }}" method="POST" style="display: none;">
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

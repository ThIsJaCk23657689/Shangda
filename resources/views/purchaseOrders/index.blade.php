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
			<a href="{{ route('purchase.index') }}">{{ __('Purchase Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('purchase.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus mr-2"></i>
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
                                    @if($purchaseOrder->received_at == null)
                                        <button type="button" class="btn btn-md btn-primary received-btn" data-toggle="modal" data-target="#ReceivedModal" data-id="{{ $purchaseOrder->id }}" data-expect-received-at="{{ $purchaseOrder->showExpectReceivedAtDate() }}">
                                            <i class="fas fa-truck-loading"></i>
                                            到貨
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-md btn-danger cancle-received-btn">
                                            <i class="fas fa-undo-alt"></i>
                                            取消到貨
                                        </button>
                                        <form id="cancle-received-form-{{ $purchaseOrder->id }}" class="cancle-received-form" action="{{ route('purchase.received') }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="purchase_id" value="{{ $purchaseOrder->id }}">
                                        </form>
                                    @endif

                                    @if($purchaseOrder->paid_at == null)
                                        <button type="button" class="btn btn-md btn-primary paid-btn" data-toggle="modal" data-target="#PaidModal" data-id="{{ $purchaseOrder->id }}">
                                            <i class="fas fa-hand-holding-usd"></i>
										    確認付清
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-md btn-danger cancle-paid-btn">
                                            <i class="fas fa-undo-alt"></i>
                                            取消付清
                                        </button>
                                        <form id="cancle-paid-form-{{ $purchaseOrder->id }}" class="cancle-paid-form" action="{{ route('purchase.paid') }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="purchase_id" value="{{ $purchaseOrder->id }}">
                                        </form>
                                    @endif

									<a href="{{ route('purchase.show', [$purchaseOrder->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
									</a>

									@if ($purchaseOrder->paid_at == null && $purchaseOrder->received_at == null)
										<a href="{{ route('purchase.edit', [$purchaseOrder->id]) }}" class="btn btn-md btn-success">
											<i class="fas fa-edit"></i>
										</a>
										<a href="#" class="btn btn-md btn-danger" onclick="
											event.preventDefault();
											Swal.fire({
												title: '注意！',
												text: '您確定要刪除此進貨單嗎?（此步驟不可復原）。',
												icon: 'warning',
												showCancelButton: true,
												confirmButtonColor: '#3085d6',
												cancelButtonColor: '#d33',
												confirmButtonText: '確認',
												cancelButtonText: '取消',
											}).then((result) => {
												if (result.value) {
													$('#deleteform-{{ $purchaseOrder->id }}').submit();
												}
											});
										">
											<i class="far fa-trash-alt"></i>
										</a>
										<form id="deleteform-{{ $purchaseOrder->id }}" action="{{ route('purchase.destroy', [$purchaseOrder->id]) }}" method="POST" style="display: none;">
											@csrf
											@method('DELETE')
										</form>
									@endif

								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted"> {{ __('Last Updated') }} {{ $lastUpdate??'無' }}</div>
    </div>

    @include('partials.backend.modals.purchase.received')
    @include('partials.backend.modals.purchase.paid')

@endsection

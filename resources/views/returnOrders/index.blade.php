@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
	{{-- <script src="{{ asset('js/orders/return/index.js') }}" defer></script> --}}
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Orders Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('return.index') }}">{{ __('Return Orders') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('return.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus mr-2"></i>
                新增退貨單
            </a>
        </div>
    </div>

	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			退貨單資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>顧客名稱</th>
                            <th>總退款金額(含稅)</th>
							<th>退款日</th>
							<th>建單日期</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($returnOrders as $returnOrder)
							<tr>
								<td>{{ $returnOrder->consumer->name }}</td>
								<td>{{ $returnOrder->totalTaxPrice }}</td>
								<td>{{ $returnOrder->paid_at ? $returnOrder->paid_at->toDateString() : '尚未確認退款' }}</td>
								<td>{{ $returnOrder->created_at->toDateString() }}</td>
								<td>
                                    @if($returnOrder->paid_at == null)
                                        <a href="#" class="btn btn-md btn-primary" onclick="
                                        event.preventDefault();

                                        Swal.fire({
                                            title: '注意！',
                                            text: '您確定要退款嗎?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: '確認',
                                            cancelButtonText: '取消',
                                        }).then((result) => {
                                            if (result.value) {
                                                $('#refund-form-{{ $returnOrder->id }}').submit();
                                            }
                                        });
                                    ">
                                            <i class="far fa-trash-alt"></i>
                                            確認退款
                                        </a>
                                    @else
                                    <a href="#" class="btn btn-md btn-danger" onclick="
                                        event.preventDefault();

                                        Swal.fire({
                                            title: '注意！',
                                            text: '您確定要取消退款嗎?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: '確認',
                                            cancelButtonText: '取消',
                                        }).then((result) => {
                                            if (result.value) {
                                                $('#refund-form-{{ $returnOrder->id }}').submit();
                                            }
                                        });
                                    ">
                                        <i class="far fa-trash-alt"></i>
                                        取消退款
                                    </a>

                                    @endif
                                    <form id="refund-form-{{ $returnOrder->id }}" action="{{ route('return.refundConfirm', [$returnOrder->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PATCH')
                                    </form>

									<a href="{{ route('return.show', [$returnOrder->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
                                    </a>
                                    @if ($returnOrder->paid_at == null)
                                        <a href="{{ route('return.edit', [$returnOrder->id]) }}" class="btn btn-md btn-success">
                                            <i class="fas fa-edit"></i>
                                            編輯
                                        </a>
                                        <a href="#" class="btn btn-md btn-danger" onclick="
                                            event.preventDefault();

                                            Swal.fire({
                                                title: '注意！',
                                                text: '您確定要刪除此進貨單嗎?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: '確認',
                                                cancelButtonText: '取消',
                                            }).then((result) => {
                                                if (result.value) {
                                                    $('#deleteform-{{ $returnOrder->id }}').submit();
                                                }
                                            });
                                        ">
                                            <i class="far fa-trash-alt"></i>
                                            刪除
                                        </a>
                                        <form id="deleteform-{{ $returnOrder->id }}" action="{{ route('return.destroy', [$returnOrder->id]) }}" method="POST" style="display: none;">
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
@endsection

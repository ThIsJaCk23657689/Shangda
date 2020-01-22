@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
@endpush 

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增供應商
            </a>
        </div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			供應商資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>編號</th>
							<th>簡稱</th>
							<th>統一編號</th>
                            <th>負責人姓名</th>
                            <th>負責人電話</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($suppliers as $supplier)
							<tr>
								<td>{{ $supplier->id }}</td>
								<td>{{ $supplier->shortName }}</td>
								<td>{{ $supplier->taxId }}</td>
                                <td>{{ $supplier->inCharge1 }}</td>
                                <td>{{ $supplier->tel1 }}</td>
								<td>
									<a href="{{ route('suppliers.show', [$supplier->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									<a href="{{ route('suppliers.edit', [$supplier->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();
										ans = confirm('確定要刪除此廠商嗎?');
										if(ans){
											$('#deleteform-{{ $supplier->id }}').submit();
										}
									">
										<i class="far fa-trash-alt"></i>
										刪除
									</a>

									<form id="deleteform-{{ $supplier->id }}" action="{{ route('suppliers.destroy', [$supplier->id]) }}" method="POST" style="displat: none;">
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

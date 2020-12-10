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
			<a href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('consumers.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增顧客
            </a>
        </div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			顧客資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>編號</th>
							<th>名稱</th>
							<th>統一編號</th>
							<th>聯絡人名稱</th>
							<th>聯絡人電話</th>
                            <th>未沖帳總額</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($consumers as $consumer)
							<tr class="{{ $consumer->trashed()?'bg-warning':'' }}">
								<td>{{ $consumer->id }}</td>
								<td>{{ $consumer->name }}</td>
								<td>{{ $consumer->taxID ?? '無' }}</td>
								@if ($consumer->account_type == 1)
									<td>{{ $consumer->operator_name_1 ?? '無' }}</td>
									<td>{{ $consumer->operator_tel_1 ?? '無' }}</td>
								@else	
									<td>{{ $consumer->operator_name_1 ?? '無' }}</td>
									<td>{{ $consumer->phone ?? '無' }}</td>
								@endif
                                <td>{{ $consumer->uncheckedAmount }}</td>
								<td>
									<a href="{{ route('consumers.show', [$consumer->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									<a href="{{ route('consumers.edit', [$consumer->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									@if($consumer->trashed())
										<a href="#" class="btn btn-md btn-light" onclick="
											event.preventDefault();
											Swal.fire({
												title: '注意！',
												text: '確定要解鎖此顧客嗎？',
												icon: 'warning',
												showCancelButton: true,
												confirmButtonColor: '#3085d6',
												cancelButtonColor: '#d33',
												confirmButtonText: '確認',
												cancelButtonText: '取消',
											}).then((result) => {
												if (result.value) {
													$('#deleteform-{{ $consumer->id }}').submit();
												}
											});
										">
											<i class="fas fa-unlock"></i>
											解鎖
										</a>
									@else
										<a href="#" class="btn btn-md btn-danger" onclick="
											event.preventDefault();
											Swal.fire({
												title: '注意！',
												text: '確定要封鎖此顧客嗎？',
												icon: 'warning',
												showCancelButton: true,
												confirmButtonColor: '#3085d6',
												cancelButtonColor: '#d33',
												confirmButtonText: '確認',
												cancelButtonText: '取消',
											}).then((result) => {
												if (result.value) {
													$('#deleteform-{{ $consumer->id }}').submit();
												}
											});
										">
											<i class="fas fa-user-slash"></i>
											封鎖
										</a>
									@endif
									<form id="deleteform-{{ $consumer->id }}" action="{{ route('consumers.destroy', [$consumer->id]) }}" method="POST" style="displat: none;">
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

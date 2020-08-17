@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('System Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('announcements.index') }}">{{ __('News') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('announcements.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增最新消息
			</a>
		</div>
    </div>

	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			最新消息列表
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th>編號</th>
							<th>標題</th>
							<th>最後編輯者</th>
							<th>建立日期</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($announcements as $announcement)
							<tr>
                                <td>{{ $announcement->id }}</td>
								<td>{{ $announcement->title }}</td>
								<td>{{ $announcement->user->name }}</td>
								<td>{{ $announcement->created_at }}</td>
								<td>
									<a href="{{ route('announcements.show', [$announcement->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
									</a>
									<a href="{{ route('announcements.edit', [$announcement->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
									</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();

										Swal.fire({
											title: '注意！',
											text: '您確定要刪除此消息嗎？',
											icon: 'warning',
											showCancelButton: true,
											confirmButtonColor: '#3085d6',
											cancelButtonColor: '#d33',
											confirmButtonText: '確認',
											cancelButtonText: '取消',
										}).then((result) => {
											if (result.value) {
												$('#deleteform-{{ $announcement->id }}').submit();
											}
										});
										">
										<i class="fas fa-trash-alt"></i>
										刪除
									</a>

									<form id="deleteform-{{ $announcement->id }}" action="{{ route('announcements.destroy', [$announcement->id]) }}" method="POST" style="displat: none;">
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

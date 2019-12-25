@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">{{ __('Material') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('materials.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增原物料
            </a>
        </div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			原物料資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>編號</th>
							<th>名稱</th>
							<th>國際條碼</th>
							<th>單位</th>
							<th>單價</th>
							<th>備註</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($materials as $material)
							<tr>
								<td>{{ $material->id }}</td>
								<td>{{ $material->name }}</td>
								<td>{{ $material->internationalNum }}</td>
								<td>{{ $material->unit }}</td>
								<td>{{ $material->unitPrice }}</td>
								<td>{{ $material->comment  }}</td>
								<td>
									<a href="{{ route('materials.show', [$material->id]) }}" class="btn btn-md btn-info">查看</a>
                                    <a href="{{ route('materials.edit', [$material->id]) }}" class="btn btn-md btn-success">編輯</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();
										ans = confirm('確定要刪除此廠商嗎?');
										if(ans){
											$('#deleteform-{{ $material->id }}').submit();
										}
									">刪除</a>

									<form id="deleteform-{{ $material->id }}" action="{{ route('materials.destroy', [$material->id]) }}" method="POST" style="displat: none;">
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

@extends('layouts.backend.master')

@push('CustomJS')
	<script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('Stuffs Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('produces.index') }}">{{ __('Produces') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('produces.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增商品庫存
			</a>
		</div>
    </div>

	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			商品庫存資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th>編號</th>
                            <th>產出商品數</th>
                            <th>投入原料數</th>
                            <th>時間</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($produces as $produce)
							<tr>
                                <td>{{ $produce->id }}</td>
                                <td>{{ $produce->produceProducts()->count() }}</td>
								<td>{{ $produce->produceDetails()->count() }}</td>
								<td>{{ $produce->created_at }}</td>
								<td>
									<a href="{{ route('produces.show', [$produce->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									<a href="{{ route('produces.edit', [$produce->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									<a href="#" class="btn btn-md btn-danger" onclick="
										event.preventDefault();
										ans = confirm('確定要刪除此增量嗎?(將會還原至尚未增量之前。)');
										if(ans){
											$('#deleteform-{{ $produce->id }}').submit();
										}
									">
										<i class="far fa-trash-alt"></i>
										刪除
									</a>
									<form id="deleteform-{{ $produce->id }}" action="{{ route('produces.destroy', [$produce->id]) }}" method="POST" style="displat: none;">
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

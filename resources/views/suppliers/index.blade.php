@extends('layouts.backend.master')

@section('content')
				
	@include('partials.backend.breadcrumbs')

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
							<th>電話</th>
							<th>傳真</th>
							<th>負責人</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($suppliers as $supplier)
							<tr>
								<td>{{ $supplier->id }}</td>
								<td>{{ $supplier->shortName }}</td>
								<td>{{ $supplier->taxId }}</td>
								<td>{{ $supplier->genre->tel }}</td>
								<td>{{ $supplier->tax }}</td>
								<td>{{ $supplier->inCharge1 }}</td>
								<td>
									<a href="#" class="btn btn-md btn-success">編輯</a>
									<a href="#" class="btn btn-md btn-danger">刪除</a>
								</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
	
@endsection

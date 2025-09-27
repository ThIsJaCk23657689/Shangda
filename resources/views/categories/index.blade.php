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
			<a href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('categories.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增商品類別
            </a>
        </div>
    </div>

	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			商品類別列表
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th style="width: 8%">編號</th>
                            <th style="width: 15%">名稱</th>
							<th>簡介</th>
							<th style="width: 8%">商品數</th>
							<th style="width: 30%">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($categories as $category)
							<tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
								<td>{{ ($category->intro == "") ? '無' : $category->intro }}</td>
								<td>{{ $category->products()->count() }}</td>
								<td>
									<a href="{{ route('categories.show', [$category->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
										查看
									</a>
									{{-- <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
									@if($category->id != 1)
										<a href="#" class="btn btn-md btn-danger" onclick="
											event.preventDefault();
											ans = confirm('確定要刪除此類別嗎?');
											if(ans){
												$('#deleteform-{{ $category->id }}').submit();
											}
										">
											<i class="far fa-trash-alt"></i>
											刪除
										</a>

										<form id="deleteform-{{ $category->id }}" action="{{ route('categories.destroy', [$category->id]) }}" method="POST" style="displat: none;">
											@csrf
											@method('DELETE')
										</form>
									@endif --}}
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

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
			<a href="#">{{ __('Products') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent

	<div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('products.create') }}" class="btn btn-md btn-primary">
                <i class="fas fa-plus"></i>
                新增商品
			</a>
			<a href="{{ route('produces.create') }}" class="btn btn-md btn-warning">
                新增商品庫存
            </a>
		</div>
    </div>
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			商品資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th>編號</th>
							<th>名稱</th>
							<th>類別</th>
							<th>零售價</th>
							<th>目前存貨量</th>
							<th>單位</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							<tr class="{{ $product->trashed()?'bg-warning':'' }}">
                                <td>{{ $product->shownID }}</td>
								<td>{{ $product->name }}</td>
								<td>
									<a href="{{ route('categories.show', [$product->category->id]) }}">
										{{ $product->category->name }}
									</a>
								</td>
								<td>{{ $product->retailPrice }}</td>
								<td>{{ $product->quantity }}</td>
								<td>{{ $product->showUnit() }}</td>
								<td>
									<a href="{{ route('products.show', [$product->id]) }}" class="btn btn-md btn-info">
										<i class="fas fa-info-circle"></i>
									</a>
									<a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
									</a>
									@if($product->trashed())
										<a href="#" class="btn btn-md btn-light" onclick="
											event.preventDefault();
											ans = confirm('確定要上架此商品嗎?');
											if(ans){
												$('#deleteform-{{ $product->id }}').submit();
											}
										">
											<i class="fas fa-arrow-alt-circle-up"></i>
											上架
										</a>
									@else
										<a href="#" class="btn btn-md btn-danger" onclick="
											event.preventDefault();
											ans = confirm('確定要下架此商品嗎?');
											if(ans){
												$('#deleteform-{{ $product->id }}').submit();
											}
										">
											<i class="fas fa-arrow-alt-circle-down"></i>
											下架
										</a>
									@endif
									<form id="deleteform-{{ $product->id }}" action="{{ route('products.destroy', [$product->id]) }}" method="POST" style="displat: none;">
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

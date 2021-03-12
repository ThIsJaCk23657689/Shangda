@extends('layouts.backend.master')

@push('CustomJS')
    {{-- <script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script> --}}
    <script src="{{ asset('js/discounts/index.js') }}" defer></script>
@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('discounts.index') }}">{{ __('Discounts') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
    @endcomponent

    <div class="row mb-3 px-2">
        <div class="col-md-12">
            <span class="mr-2">以</span>
            <select id="sortType" class="form-control mr-2" style="display: inline-block; width: auto;">
                <option value="consumers">顧客</option>
                <option value="products">商品</option>
            </select>
            <span>為列</span>
        </div>
    </div>

    <div id="consumers_card" class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			顧客資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="consumers_dataTable" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>編號</th>
                            <th>帳號</th>
							<th>名稱</th>
                            <th>統編</th>
							<th>聯絡人名稱</th>
							<th>聯絡人電話</th>
                            <th>折扣商品數</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($consumers as $consumer)
							<tr class="{{ $consumer->trashed()?'bg-warning':'' }}">
								<td>{{ $consumer->id }}</td>
                                <td>{{ $consumer->account }}</td>
                                <td>{{ $consumer->name }}</td>
								<td>{{ $consumer->taxID ?? '無' }}</td>
								<td>{{ $consumer->operator_name ?? '無' }}</td>
								<td>{{ $consumer->operator_tel ?? $consumer->tel ?? $consumer->phone }}</td>
								<td>{{ $consumer->products()->count() }}</td>
                                <td>
									<a href="{{ route('consumers.showDiscountsPage', [$consumer->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>

    <div id="products_card" class="card mb-3" style="display: none;">
		<div class="card-header">
			<i class="fas fa-table"></i>
			商品資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="products_dataTable" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th>編號</th>
							<th>名稱</th>
							<th>類別</th>
							<th>零售價</th>
							<th>折扣顧客數</th>
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
								<td>{{ $product->consumers()->count() }}</td>
								<td>
									<a href="{{ route('products.showDiscountsPage', [$product->id]) }}" class="btn btn-md btn-success">
										<i class="fas fa-edit"></i>
										編輯
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection

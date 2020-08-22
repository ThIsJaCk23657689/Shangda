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
			<a href="{{ route('contacts.index') }}">{{ __('Contacts') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Index') }}</li>
	@endcomponent
	
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			聯絡資料
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>編號</th>
							<th>名稱</th>
							<th>性別</th>
							<th>電話</th>
							<th>信箱</th>
                            <th>LineID</th>
                            <th>感興趣商品</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($contacts as $contact)
							<tr>
								<td>{{ $contact->id }}</td>
								<td>{{ $contact->name }}</td>
								<td>{{ $contact->showGender() }}</td>
								<td>{{ $contact->phone }}</td>
								<td>{{ $contact->email ?? '無' }}</td>
                                <td>{{ $contact->lineID ?? '無' }}</td>
                                <td>{{ $contact->product->name }}</td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted"> {{ __('Last Updated') }} {{ $lastUpdate??'無' }}</div>
	</div>

@endsection

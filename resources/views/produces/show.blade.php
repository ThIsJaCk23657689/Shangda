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
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
    @endcomponent
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>投入原物料細項</h4>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>原物料</th>
                                <th>消耗數量</th>
                                <th>目前庫存</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produce->produceDetails as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('materials.show', [$detail->material->id]) }}">
                                            {{ $detail->material->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $detail->quantity }}
                                        {{ $detail->material->showUnit() }}
                                    </td>
                                    <td>
                                        {{ $detail->material->showStock() }}
                                        {{ $detail->material->showUnit() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>產出商品細項</h4>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>商品</th>
                                <th>生產數量</th>
                                <th>目前庫存</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produce->produceProducts as $detail)
                                <tr>
                                    <td style="width: 5%">{{ $loop->iteration }}</td>
                                    <td style="width: 20%">
                                        <a href="{{ route('products.show', [$detail->product->id]) }}">
                                            {{ $detail->product->name }}
                                        </a>
                                    </td>
                                    <td style="width: 10%">
                                        {{ $detail->quantity }}
                                        {{ $detail->product->showUnit() }}
                                    </td>
                                    <td style="width: 15%">
                                        {{ $detail->product->quantity }}
                                        {{ $detail->product->showUnit() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_id">創建者</label>
                        <input id="user_id" type="text" class="form-control" value="{{ $produce->user->name }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="last_user_id">最後修改者</label>
                        <input id="last_user_id" type="text" class="form-control" value="{{ $produce->showLastUpdater() }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">建立日期</label>
                        <input id="created_at" type="text" class="form-control" value="{{ $produce->created_at }}" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="updated_at">最後更新日期</label>
                        <input id="updated_at" type="text" class="form-control" value="{{ $produce->updated_at }}" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('produces.index') }}" class="btn btn-block btn-danger">
                        返回首頁
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

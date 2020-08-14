@extends('layouts.backend.master')

@push('CustomJS')

@endpush

@section('content')

	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('System Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('announcements.index') }}">{{ __('News') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">
                        標題
                    </label>

                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control" value="{{ $announcement->title }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label text-md-right">
                        封面圖片
                    </label>

                    <div class="col-md-10">
                        <img src="{{ $announcement->showCoverImage() }}" alt="" width="250px">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label text-md-right">
                        內容
                    </label>

                    <div class="col-md-10">
                        <textarea id="content" name="content" type="text" rows="10" class="form-control" readonly>{{  $announcement->content }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label text-md-right">
                        最後編輯者
                    </label>
                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control" value="{{ $announcement->user->name }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label text-md-right">
                        建立日期
                    </label>
                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control" value="{{ $announcement->created_at }}" disabled>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <a href="{{ route('announcements.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>
        </div>
    </div>

@endsection

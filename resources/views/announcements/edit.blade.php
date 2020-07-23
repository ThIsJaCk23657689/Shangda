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
		<li class="breadcrumb-item active">{{ __('Edit') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('announcements.update' , [$announcement->id]) }}">
                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="title"" class="col-md-2 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        標題
                    </label>

                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $announcement->title }}" required autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content"" class="col-md-2 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        內容
                    </label>

                    <div class="col-md-10">
                        <textarea id="content" name="content" type="text" rows="10" class="form-control @error('content') is-invalid @enderror">{{ $announcement->content }}</textarea>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-success">
                            確認修改
                        </button>
                        <a href="{{ route('announcements.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

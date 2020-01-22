@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('users.index') }}">{{ __('Staffs') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Create') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        名稱
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        性別
                    </label>

                    <div class="col-md-6">
                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="0">女</option>
                            <option value="1">男</option>
                        </select>

                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jobTitle" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        職稱
                    </label>

                    <div class="col-md-6">
                        <select id="jobTitle" class="form-control @error('jobTitle') is-invalid @enderror" name="jobTitle">
                            @foreach ($jobTitles as $jobTitle)
                                <option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
                            @endforeach
                        </select>

                        @error('jobTitle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        信箱
                    </label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        密碼
                    </label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                        <span class="text-danger">*</span>
                        確認密碼
                    </label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認新增
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
	
@endsection

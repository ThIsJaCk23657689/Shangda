@extends('layouts.backend.master')

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('users.index') }}">{{ __('Staffs') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">姓名</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">信箱</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="gender">性別</label>
                        <input id="gender" name="gender" type="text" class="form-control" value="{{ $user->showGender() }}" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="jobTitle">職稱</label>
                        <input id="jobTitle" name="jobTitle" type="text" class="form-control" value="{{ $user->jobTitle->name }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="account">帳號</label>
                        <input id="account" name="account" type="text" class="form-control" value="{{ $user->account }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="created_at">建立時間</label>
                        <input id="created_at" name="created_at" type="text" class="form-control" value="{{ $user->created_at }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="updated_at">更新時間</label>
                        <input id="updated_at" name="updated_at" type="text" class="form-control" value="{{ $user->updated_at }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tel">電話</label>
                        <input id="tel" name="tel" type="text" class="form-control" value="{{ $user->tel ?? '無資料' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">手機</label>
                        <input id="phone" name="phone" type="text" class="form-control" value="{{ $user->phone ?? '無資料' }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input id="birthday" name="birthday" type="text" class="form-control" value="{{ $user->showBirthday() ?? '無資料' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="comment">備註內容</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" readonly>{{ $user->comment }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input id="address" name="address" type="text" class="form-control" value="{{ $user->showAddress() ?? '無資料' }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="age">年齡</label>
                        <input id="age" name="age" type="text" class="form-control" value="{{ $user->showAge() ?? '無資料' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-block btn-success">
                        編輯資料
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>

        </div>
    </div>
	
@endsection

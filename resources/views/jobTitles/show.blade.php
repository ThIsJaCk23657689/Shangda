@extends('layouts.backend.master')

@push('CustomJS')
    <script src="{{ asset('js/admin/demo/datatables-demo.js') }}" defer></script>
@endpush    

@section('content')
				
	@component('components.breadcrumbs')
		<li class="breadcrumb-item">
			<a href="#">{{ __('People Management') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('jobtitles.index') }}">{{ __('Job Titles') }}</a>
		</li>
		<li class="breadcrumb-item active">{{ __('Show') }}</li>
	@endcomponent

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    <span class="text-danger">*</span>
                    職稱名稱
                </label>
            
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $jobtitle->name }}" disabled>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>任職此職位的員工</h3>
                </div>

                <div class="col-md-12">
                    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>名稱</th>
                                <th>性別</th>
                                <th>信箱</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobtitle->usersWithTrashed() as $user)
                                <tr class="{{ $user->trashed()?'bg-warning':'' }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->showGender() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-md btn-info">
                                            <i class="fas fa-info-circle"></i>
                                            查看
                                        </a>
                                        @if($user->id != 1)
                                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-md btn-success">
                                                <i class="fas fa-user-edit"></i>
                                                編輯
                                            </a>
                                            @if(Auth::id() != $user->id)
                                                @if($user->trashed())
                                                    <a href="#" class="btn btn-md btn-light" onclick="
                                                        event.preventDefault();
                                                        ans = confirm('確定要解鎖此員工嗎?');
                                                        if(ans){
                                                            $('#deleteform-{{ $user->id }}').submit();
                                                        }
                                                    ">
                                                        <i class="fas fa-unlock"></i>
                                                        解鎖
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-md btn-danger" onclick="
                                                        event.preventDefault();
                                                        ans = confirm('確定要封鎖此員工嗎?');
                                                        if(ans){
                                                            $('#deleteform-{{ $user->id }}').submit();
                                                        }
                                                    ">
                                                        <i class="fas fa-user-slash"></i>
                                                        封鎖
                                                    </a>
                                                @endif
    
                                                <form id="deleteform-{{ $user->id }}" action="{{ route('users.destroy', [$user->id]) }}" method="POST" style="displat: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>	
                            @endforeach
                        </tbody>
                    </table>
            
                </div>
            </div>

            <hr>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <a href="{{ route('jobtitles.index') }}" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>
        </div>
    </div>
	
@endsection

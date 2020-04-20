@extends('layouts.app')

@section('title', '修改' . __('password.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">修改{{ __('password.module') }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('passwords.update') }}">
                @csrf
                @method('put')
                <div class="card-body">
	                <div class="form-group row">
	                    <label for="old_password" class="col-sm-2 col-form-label">旧密码</label>
	                    <div class="col-md-10">
	                    	<input type="password" name="old_password" id="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="旧密码" value="{{ old('old_password') }}" required focus>
	                        @if ($errors->has('old_password'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('old_password') }}</strong>
		                        </div>
	                        @endif
	                    </div>
                    </div>
                    
	                <div class="form-group row">
	                    <label for="password" class="col-sm-2 col-form-label">新密码</label>
	                    <div class="col-md-10">
	                    	<input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="新密码" required>
	                        @if ($errors->has('password'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('password') }}</strong>
		                        </div>
	                        @endif
	                        <small class="form-text text-muted">密码至少8位</small>
	                    </div>
                    </div>
                    
	                <div class="form-group row">
	                    <label for="password_confirmation" class="col-sm-2 col-form-label">确认密码</label>
	                    <div class="col-md-10">
	                    	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="确认密码" required>
	                        @if ($errors->has('password_confirmation'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('password_confirmation') }}</strong>
		                        </div>
	                        @endif
	                    </div>
	                </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> 确认修改
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

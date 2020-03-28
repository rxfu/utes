@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-sm-6 offset-sm-3">
		<div class="card">
			<div class="card-header card-info">
				<h3 class="card-title">修改密码</h3>
			</div>

		    <form role="form" id="change-password-form" name="change-password-form" method="post" action="{{ route('password.change') }}" aria-label="修改密码">
		    	@method('put')
		        @csrf
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
	                        <small class="form-text text-muted">密码至少6位</small>
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
						<div class="col-sm-auto">
					        <button type="submit" class="btn btn-primary">
					            <i class="icon fas fa-save"></i> 确认修改
					        </button>
					    </div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
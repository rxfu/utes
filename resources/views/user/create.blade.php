@extends('layouts.app')

@section('title', __('Create') . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('user.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.username') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" placeholder="{{ __('user.username') }}" value="{{ old('username') }}" required>
                            @if ($errors->has('username'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label text-right">{{ __('user.password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="{{ __('user.password') }}" value="{{ old('password') }}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
	                        <small class="form-text text-muted">密码至少8位</small>
                        </div>
                    </div>

	                <div class="form-group row">
	                    <label for="password_confirmation" class="col-sm-3 col-form-label text-right">{{ __('user.password_confirmation') }}</label>
	                    <div class="col-md-9">
	                    	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password_confirmation') }}" required>
	                        @if ($errors->has('password_confirmation'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('password_confirmation') }}</strong>
		                        </div>
	                        @endif
	                    </div>
	                </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('user.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable1" class="form-check-input{{ $errors->has('is_enable') ? ' is-invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input{{ $errors->has('is_enable') ? ' is-invalid' : '' }}" value="0">
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                            @if ($errors->has('is_enable'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_enable') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

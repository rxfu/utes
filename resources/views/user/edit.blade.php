@extends('layouts.app')

@section('title', '编辑' . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('user.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('users.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">{{ __('user.username') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('username') ? ' is_invalid' : '' }}" name="username" id="username" placeholder="{{ __('user.username') }}" value="{{ old('username', $item->username) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">{{ __('user.password') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('password') ? ' is_invalid' : '' }}" name="password" id="password" placeholder="{{ __('user.password') }}" value="{{ old('password', $item->password) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name', $item->name) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">{{ __('user.email') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is_invalid' : '' }}" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email', $item->email) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email_verified_at" class="col-sm-3 col-form-label">{{ __('user.email_verified_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="email_verified_at" id="email_verified_at" class="form-control{{ $errors->has('email_verified_at']) ? ' is_invalid' : '' }}" placeholder="{{ __('user.email_verified_at') }}" value="{{ old('email_verified_at', $item->email_verified_at) }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label">{{ __('user.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="1"{{ old('is_enable', $item->is_enable) === true ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="0"{{ old('is_enable', $item->is_enable) === false ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_super" class="col-sm-3 col-form-label">{{ __('user.is_super') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_super" id="is_super" class="form-check-input{{ $errors->has('is_super') ? ' is_invalid' : '' }}" value="1"{{ old('is_super', $item->is_super) === true ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_super1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_super" id="is_super0" class="form-check-input{{ $errors->has('is_super') ? ' is_invalid' : '' }}" value="0"{{ old('is_super', $item->is_super) === false ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_super0">否</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_login_at" class="col-sm-3 col-form-label">{{ __('user.last_login_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="last_login_at" id="last_login_at" class="form-control{{ $errors->has('last_login_at']) ? ' is_invalid' : '' }}" placeholder="{{ __('user.last_login_at') }}" value="{{ old('last_login_at', $item->last_login_at) }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> 保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', '显示' . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('user.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label">{{ __('user.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">{{ __('user.username') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="username" id="username" value="{{ $item->username }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">{{ __('user.password') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="password" id="password" value="{{ $item->password }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">{{ __('user.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">{{ __('user.email') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="email" id="email" value="{{ $item->email }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email_verified_at" class="col-sm-3 col-form-label">{{ __('user.email_verified_at') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="email_verified_at" id="email_verified_at" value="{{ $item->email_verified_at }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label">{{ __('user.is_enable') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_enable" id="is_enable" value="{{ $item->is_enable }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_super" class="col-sm-3 col-form-label">{{ __('user.is_super') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_super" id="is_super" value="{{ $item->is_super }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_login_at" class="col-sm-3 col-form-label">{{ __('user.last_login_at') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="last_login_at" id="last_login_at" value="{{ $item->last_login_at }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    <a href="{{ route('users.edit', $item->getKey()) }}" title="编辑" class="btn btn-info">
                        <i class="fas fa-pencil-alt"></i> 编辑
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ route('users.destroy', $item->getKey()) }}" class="btn btn-danger delete" title="删除">
                        <i class="fas fa-trash"></i> 删除
                    </a>
                </div>
            </div>
            <form id="delete-form" action="{{ route('users.destroy', $item->getKey()) }}" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
@endsection

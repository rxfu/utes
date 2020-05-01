@extends('layouts.app')

@section('title', __('Show') . __('user.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('user.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('user.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.username') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="username" id="username" value="{{ $item->username }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="email" id="email" value="{{ $item->email }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email_verified_at" class="col-sm-3 col-form-label text-right">{{ __('user.email_verified_at') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="email_verified_at" id="email_verified_at" value="{{ $item->email_verified_at }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('user.is_enable') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_enable" id="is_enable" value="{{ $item->present()->isEnable }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_super" class="col-sm-3 col-form-label text-right">{{ __('user.is_super') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_super" id="is_super" value="{{ $item->present()->isSuper }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_login_at" class="col-sm-3 col-form-label text-right">{{ __('user.last_login_at') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="last_login_at" id="last_login_at" value="{{ $item->last_login_at }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('users.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('users.destroy', $item) }}" class="btn btn-danger delete" title="删除" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </a>
                    @endcan
                </div>
            </div>
            @can('delete', $item)
                <form id="delete-form" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection

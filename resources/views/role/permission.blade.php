@extends('layouts.app')

@section('title', __('Grant Permission'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Grant Permission') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="grant-form" name="grant-form" method="post" action="{{ route('roles.permission', $item->getKey()) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="permissions" class="col-sm-3 col-form-label text-right">{{ __('permission.module') }}</label>
                        <div class="col-sm-9">
                            @inject('permissions', 'App\Services\PermissionService')
                            @foreach ($permissions->getAll() as $item)
                                <div class="icheck-warning icheck-inline">
                                    <input type="checkbox" name="permissions[]" id="permission{{ $loop->index }}" class="form-check-input{{ $errors->has('permissions[]') ? ' is-invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $grantedPermissions) ? ' checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $loop->index }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            @if ($errors->has('permissions[]'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('permissions[]') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', __('Grant Role'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Grant Role') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="grant-form" name="grant-form" method="post" action="{{ route('users.role', $item->getKey()) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="roles" class="col-sm-3 col-form-label text-right">{{ __('role.module') }}</label>
                        <div class="col-sm-9">
                            @inject('roles', 'App\Services\RoleService')
                            @foreach ($roles->getAll() as $item)
                                <div class="icheck-warning icheck-inline">
                                    <input type="checkbox" name="roles[]" id="role{{ $loop->index }}" class="form-check-input{{ $errors->has('roles[]') ? ' is-invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $grantedRoles) ? ' checked' : '' }}>
                                    <label class="form-check-label" for="role{{ $loop->index }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            @if ($errors->has('roles[]'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roles[]') }}</strong>
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

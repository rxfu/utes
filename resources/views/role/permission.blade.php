@extends('layouts.app')

@section('title', __('Assign Permission'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Assign Permission') }}: {{ $item->name }}</h3>
            </div>

		    <form role="form" id="assign-form" name="assign-form" method="post" action="{{ route('roles.permission', $item->getKey()) }}">
                @csrf
                <div class="card-body">
                    
                    @inject('permissions', 'App\Services\PermissionService')
                    @foreach ($permissions->getAll()->groupBy('model') as $model => $items)
                        <div class="form-group row">
                            <label for="permissions" class="col-sm-2 col-form-label text-right">{{ __($model . '.module') }}</label>
                            <div class="col-sm-10">
                                @foreach ($items as $item)
                                    <div class="icheck-warning icheck-inline">
                                        <input type="checkbox" name="permissions[]" id="permission{{ $item->id }}" class="form-check-input{{ $errors->has('permissions[]') ? ' is-invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $assignedPermissions) ? ' checked' : '' }}>
                                        <label class="form-check-label" for="permission{{ $item->id }}">{{ __($item->action) }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('permissions[]'))
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('permissions[]') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
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

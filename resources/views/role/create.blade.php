@extends('layouts.app')

@section('title', __('Create') . __('role.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('role.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('roles.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('role.slug') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" placeholder="{{ __('role.slug') }}" value="{{ old('slug') }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('role.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('role.name') }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('role.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('roles', 'App\Services\RoleService')
							<select name="parent_id" id="parent_id" class="form-control select2 select2-success{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                <option value="">无</option>
                                @foreach ($roles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('role.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('role.description') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
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

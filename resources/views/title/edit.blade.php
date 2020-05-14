@extends('layouts.app')

@section('title', __('Edit') . __('title.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('title.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('titles.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('title.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('title.name') }}" value="{{ old('name', $item->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_allowed" class="col-sm-3 col-form-label text-right">{{ __('title.is_allowed') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_allowed" id="is_allowed1" class="form-check-input{{ $errors->has('is_allowed') ? ' is-invalid' : '' }}" value="1"{{ old('is_allowed', $item->is_allowed) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_allowed1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_allowed" id="is_allowed0" class="form-check-input{{ $errors->has('is_allowed') ? ' is-invalid' : '' }}" value="0"{{ old('is_allowed', $item->is_allowed) == 0 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_allowed0">否</label>
                            </div>
                            @if ($errors->has('is_allowed'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_allowed') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('title.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('title.description') }}">{{ old('description', $item->description) }}</textarea>
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
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

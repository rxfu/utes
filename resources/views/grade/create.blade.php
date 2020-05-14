@extends('layouts.app')

@section('title', __('Create') . __('grade.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('grade.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('grades.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('grade.slug') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" placeholder="{{ __('grade.slug') }}" value="{{ old('slug') }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('grade.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('grade.name') }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="max_score" class="col-sm-3 col-form-label text-right">{{ __('grade.max_score') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('max_score') ? ' is-invalid' : '' }}" name="max_score" id="max_score" placeholder="{{ __('grade.max_score') }}" value="{{ old('max_score') }}">
                            @if ($errors->has('max_score'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('max_score') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="min_score" class="col-sm-3 col-form-label text-right">{{ __('grade.min_score') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('min_score') ? ' is-invalid' : '' }}" name="min_score" id="min_score" placeholder="{{ __('grade.min_score') }}" value="{{ old('min_score') }}">
                            @if ($errors->has('min_score'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('min_score') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('grade.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('grade.description') }}">{{ old('description') }}</textarea>
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

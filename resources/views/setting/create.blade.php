@extends('layouts.app')

@section('title', '创建' . __('setting.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">创建{{ __('setting.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('settings.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('setting.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('setting.name') }}" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="value" class="col-sm-3 col-form-label">{{ __('setting.value') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('value') ? ' is_invalid' : '' }}" name="value" id="value" placeholder="{{ __('setting.value') }}" value="{{ old('value') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('setting.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('setting.description') }}">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="updated_at" class="col-sm-3 col-form-label">{{ __('setting.updated_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="updated_at" id="updated_at" class="form-control{{ $errors->has('updated_at']) ? ' is_invalid' : '' }}" placeholder="{{ __('setting.updated_at') }}" value="{{ old('updated_at') }}">
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
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> 创建
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', '创建' . __('menu.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">创建{{ __('menu.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('menus.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('menu.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('menu.uid') }}" value="{{ old('uid') }}">
                            @if ($errors->has('uid'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uid') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('menu.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('menu.name') }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('menu.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('menu.description') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('menu.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="0">
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                            @if ($errors->has('is_enable'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_enable') }}</strong>
                                </div>
                            @endif
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

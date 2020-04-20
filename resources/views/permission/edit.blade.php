@extends('layouts.app')

@section('title', '编辑' . __('permission.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('permission.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('permissions.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('permission.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('permission.uid') }}" value="{{ old('uid', $item->uid) }}">
                            @if ($errors->has('uid'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uid') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('permission.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('permission.name') }}" value="{{ old('name', $item->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('permission.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('permission.description') }}">{{ old('description', $item->description) }}</textarea>
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
                            <i class="fas fa-save"></i> 保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

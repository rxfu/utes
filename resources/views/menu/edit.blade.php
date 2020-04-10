@extends('layouts.app')

@section('title', '编辑' . __('menu.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('menu.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('menus.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label">{{ __('menu.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('menu.uid') }}" value="{{ old('uid', $item->uid) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('menu.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('menu.name') }}" value="{{ old('name', $item->name) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('menu.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('menu.description') }}">{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label">{{ __('menu.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="1"{{ old('is_enable', $item->is_enable) === true ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="0"{{ old('is_enable', $item->is_enable) === false ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_system" class="col-sm-3 col-form-label">{{ __('menu.is_system') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_system" id="is_system" class="form-check-input{{ $errors->has('is_system') ? ' is_invalid' : '' }}" value="1"{{ old('is_system', $item->is_system) === true ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_system1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_system" id="is_system0" class="form-check-input{{ $errors->has('is_system') ? ' is_invalid' : '' }}" value="0"{{ old('is_system', $item->is_system) === false ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_system0">否</label>
                            </div>
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

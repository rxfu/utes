@extends('layouts.app')

@section('title', '创建' . __('menuitem.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">创建{{ __('menuitem.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('menuitems.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label">{{ __('menuitem.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('menuitem.uid') }}" value="{{ old('uid') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('menuitem.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('menuitem.name') }}" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route" class="col-sm-3 col-form-label">{{ __('menuitem.route') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('route') ? ' is_invalid' : '' }}" name="route" id="route" placeholder="{{ __('menuitem.route') }}" value="{{ old('route') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-sm-3 col-form-label">{{ __('menuitem.icon') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('icon') ? ' is_invalid' : '' }}" name="icon" id="icon" placeholder="{{ __('menuitem.icon') }}" value="{{ old('icon') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label">{{ __('menuitem.parent_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('parent_id') ? ' is_invalid' : '' }}" name="parent_id" id="parent_id" placeholder="{{ __('menuitem.parent_id') }}" value="{{ old('parent_id') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menu_id" class="col-sm-3 col-form-label">{{ __('menuitem.menu_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('menu_id') ? ' is_invalid' : '' }}" name="menu_id" id="menu_id" placeholder="{{ __('menuitem.menu_id') }}" value="{{ old('menu_id') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('menuitem.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('menuitem.description') }}">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label">{{ __('menuitem.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="is_enable" id="is_enable0" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="0">
                                <label class="form-check-label" for="is_enable0">否</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="order" class="col-sm-3 col-form-label">{{ __('menuitem.order') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('order') ? ' is_invalid' : '' }}" name="order" id="order" placeholder="{{ __('menuitem.order') }}" value="{{ old('order') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="forbidden_delete" class="col-sm-3 col-form-label">{{ __('menuitem.forbidden_delete') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="forbidden_delete" id="forbidden_delete" class="form-check-input{{ $errors->has('forbidden_delete') ? ' is_invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="forbidden_delete1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="forbidden_delete" id="forbidden_delete0" class="form-check-input{{ $errors->has('forbidden_delete') ? ' is_invalid' : '' }}" value="0">
                                <label class="form-check-label" for="forbidden_delete0">否</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-foot">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-success">
                            <i class="icon fa fa-save"></i> 创建
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', '编辑' . __('menuitem.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('menuitem.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('menuitems.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label">{{ __('menuitem.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('menuitem.uid') }}" value="{{ old('uid', $item->uid) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">{{ __('menuitem.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('menuitem.name') }}" value="{{ old('name', $item->name) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route" class="col-sm-3 col-form-label">{{ __('menuitem.route') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('route') ? ' is_invalid' : '' }}" name="route" id="route" placeholder="{{ __('menuitem.route') }}" value="{{ old('route', $item->route) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-sm-3 col-form-label">{{ __('menuitem.icon') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('icon') ? ' is_invalid' : '' }}" name="icon" id="icon" placeholder="{{ __('menuitem.icon') }}" value="{{ old('icon', $item->icon) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label">{{ __('menuitem.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('parents', 'App\\Services\ParentService')
							<select name="parent_id" id="parent_id" class="form-control{{ $errors->has('parent_id') ? ' is_invalid' : '' }}">
                                @foreach ($parents->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('parent_id', $item->parent_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menu_id" class="col-sm-3 col-form-label">{{ __('menuitem.menu_id') }}</label>
                        <div class="col-sm-9">
                            @inject('menus', 'App\\Services\MenuService')
							<select name="menu_id" id="menu_id" class="form-control{{ $errors->has('menu_id') ? ' is_invalid' : '' }}">
                                @foreach ($menus->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('menu_id', $item->menu_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('menuitem.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('menuitem.description') }}">{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label">{{ __('menuitem.is_enable') }}</label>
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
                        <label for="order" class="col-sm-3 col-form-label">{{ __('menuitem.order') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('order') ? ' is_invalid' : '' }}" name="order" id="order" placeholder="{{ __('menuitem.order') }}" value="{{ old('order', $item->order) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="forbidden_delete" class="col-sm-3 col-form-label">{{ __('menuitem.forbidden_delete') }}</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="forbidden_delete" id="forbidden_delete" class="form-check-input{{ $errors->has('forbidden_delete') ? ' is_invalid' : '' }}" value="1"{{ old('forbidden_delete', $item->forbidden_delete) === true ? ' checked' : '' }}>
                                <label class="form-check-label" for="forbidden_delete1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="forbidden_delete" id="forbidden_delete0" class="form-check-input{{ $errors->has('forbidden_delete') ? ' is_invalid' : '' }}" value="0"{{ old('forbidden_delete', $item->forbidden_delete) === false ? ' checked' : '' }}>
                                <label class="form-check-label" for="forbidden_delete0">否</label>
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

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
                        <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('menuitem.uid') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('uid') ? ' is_invalid' : '' }}" name="uid" id="uid" placeholder="{{ __('menuitem.uid') }}" value="{{ old('uid') }}">
                            @if ($errors->has('uid'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uid') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('menuitem.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is_invalid' : '' }}" name="name" id="name" placeholder="{{ __('menuitem.name') }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route" class="col-sm-3 col-form-label text-right">{{ __('menuitem.route') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('route') ? ' is_invalid' : '' }}" name="route" id="route" placeholder="{{ __('menuitem.route') }}" value="{{ old('route') }}">
                            @if ($errors->has('route'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('route') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-sm-3 col-form-label text-right">{{ __('menuitem.icon') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('icon') ? ' is_invalid' : '' }}" name="icon" id="icon" placeholder="{{ __('menuitem.icon') }}" value="{{ old('icon') }}">
                            @if ($errors->has('icon'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('icon') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('menuitem.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('menuitems', 'App\Services\MenuitemService')
							<select name="parent_id" id="parent_id" class="form-control select2{{ $errors->has('parent_id') ? ' is_invalid' : '' }}">
                                <option value="">无</option>
                                @foreach ($menuitems->getLevel1Items() as $collection)
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
                        <label for="menu_id" class="col-sm-3 col-form-label text-right">{{ __('menuitem.menu_id') }}</label>
                        <div class="col-sm-9">
                            @inject('menus', 'App\Services\MenuService')
							<select name="menu_id" id="menu_id" class="form-control select2{{ $errors->has('menu_id') ? ' is_invalid' : '' }}">
                                @foreach ($menus->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('menu_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('menu_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('menuitem.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is_invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('menuitem.description') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('menuitem.is_enable') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_enable" id="is_enable1" class="form-check-input{{ $errors->has('is_enable') ? ' is_invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_enable1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
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

                    <div class="form-group row">
                        <label for="order" class="col-sm-3 col-form-label text-right">{{ __('menuitem.order') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('order') ? ' is_invalid' : '' }}" name="order" id="order" placeholder="{{ __('menuitem.order') }}" value="{{ old('order') }}">
                            @if ($errors->has('order'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('order') }}</strong>
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

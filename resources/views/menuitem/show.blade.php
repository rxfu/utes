@extends('layouts.app')

@section('title', '显示' . __('menuitem.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('menuitem.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('menuitem.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('menuitem.uid') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="uid" id="uid" value="{{ $item->uid }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('menuitem.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="route" class="col-sm-3 col-form-label text-right">{{ __('menuitem.route') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="route" id="route" value="{{ $item->route }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label text-right">{{ __('menuitem.icon') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="icon" id="icon" value="{{ $item->icon }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('menuitem.parent_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="parent_id" id="parent_id" value="{{ optional($item->parent)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="menu_id" class="col-sm-3 col-form-label text-right">{{ __('menuitem.menu_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="menu_id" id="menu_id" value="{{ optional($item->menu)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">{{ __('menuitem.description') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="description" id="description" value="{{ $item->description }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('menuitem.is_enable') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_enable" id="is_enable" value="{{ $item->present()->isEnable }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-sm-3 col-form-label text-right">{{ __('menuitem.order') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="order" id="order" value="{{ $item->order }}" readonly>
                    </div>
                </div>
            </div>

            @unless($item->is_system)
                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <a href="{{ route('menuitems.edit', $item) }}" title="编辑" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> 编辑
                        </a>
                        &nbsp;&nbsp;
                        <a href="{{ route('menuitems.destroy', $item) }}" class="btn btn-danger delete" title="删除" data-toggle="modal" data-target="#dialog" data-whatever="确认删除">
                            <i class="fas fa-trash"></i> 删除
                        </a>
                    </div>
                </div>
                <form id="delete-form" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endunless
        </div>
    </div>
</div>
@endsection

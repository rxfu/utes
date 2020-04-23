@extends('layouts.app')

@section('title', '显示' . __('menu.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('menu.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('menu.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('menu.uid') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="uid" id="uid" value="{{ $item->uid }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('menu.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">{{ __('menu.description') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="description" id="description" value="{{ $item->description }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_enable" class="col-sm-3 col-form-label text-right">{{ __('menu.is_enable') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_enable" id="is_enable" value="{{ $item->present()->isEnable }}" readonly>
                    </div>
                </div>
            </div>

            @unless($item->is_system)
                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <a href="{{ route('menus.edit', $item) }}" title="编辑" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> 编辑
                        </a>
                        &nbsp;&nbsp;
                        <a href="{{ route('menus.destroy', $item) }}" class="btn btn-danger delete" title="删除" data-toggle="modal" data-target="#dialog" data-whatever="确认删除">
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

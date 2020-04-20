@extends('layouts.app')

@section('title', '显示' . __('setting.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('setting.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('setting.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('setting.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="value" class="col-sm-3 col-form-label text-right">{{ __('setting.value') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="value" id="value" value="{{ $item->value }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">{{ __('setting.description') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="description" id="description" value="{{ $item->description }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    <a href="{{ route('settings.edit', $item->getKey()) }}" title="编辑" class="btn btn-info">
                        <i class="fas fa-pencil-alt"></i> 编辑
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ route('settings.destroy', $item->getKey()) }}" class="btn btn-danger delete" title="删除">
                        <i class="fas fa-trash"></i> 删除
                    </a>
                </div>
            </div>
            <form id="delete-form" action="{{ route('settings.destroy', $item->getKey()) }}" method="post" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
@endsection

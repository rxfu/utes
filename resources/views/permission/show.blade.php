@extends('layouts.app')

@section('title', __('Show') . __('permission.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('permission.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('permission.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('permission.slug') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="slug" id="slug" value="{{ $item->slug }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">{{ __('permission.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $item->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model" class="col-sm-3 col-form-label text-right">{{ __('permission.model') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="model" id="model" value="{{ $item->model }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-sm-3 col-form-label text-right">{{ __('permission.action') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="action" id="action" value="{{ $item->action }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="by_group" class="col-sm-3 col-form-label text-right">{{ __('permission.by_group') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="by_group" id="by_group" value="{{ $item->present()->byGroup }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('permission.parent_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="parent_id" id="parent_id" value="{{ optional($item->parent)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-right">{{ __('permission.description') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="description" id="description" value="{{ $item->description }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    <a href="{{ route('permissions.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ route('permissions.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                    </a>
                </div>
            </div>
            <form id="delete-form" method="post" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
@endsection

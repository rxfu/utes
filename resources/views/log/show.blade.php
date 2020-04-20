@extends('layouts.app')

@section('title', '显示' . __('log.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('log.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('log.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-3 col-form-label text-right">{{ __('log.created_at') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="created_at" id="created_at" value="{{ $item->created_at }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('log.user_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{ $item->user->username }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ip" class="col-sm-3 col-form-label text-right">{{ __('log.ip') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="ip" id="ip" value="{{ $item->ip }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="code" class="col-sm-3 col-form-label text-right">{{ __('log.code') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="code" id="code" value="{{ $item->code }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="path" class="col-sm-3 col-form-label text-right">{{ __('log.path') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="path" id="path" value="{{ $item->path }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="method" class="col-sm-3 col-form-label text-right">{{ __('log.method') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="method" id="method" value="{{ $item->method }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-sm-3 col-form-label text-right">{{ __('log.action') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="action" id="action" value="{{ $item->action }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model" class="col-sm-3 col-form-label text-right">{{ __('log.model') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="model" id="model" value="{{ $item->model }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model_id" class="col-sm-3 col-form-label text-right">{{ __('log.model_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="model_id" id="model_id" value="{{ $item->model_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label text-right">{{ __('log.content') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="content" id="content" value="{{ $item->content }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

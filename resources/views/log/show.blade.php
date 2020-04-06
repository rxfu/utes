@extend('layouts.app')

@section('title', "显示{{ __('log.module') }}")

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">显示{{ __('log.module') }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label">{{ __('log.user_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.user_id') }}" id="{{ __('log.user_id') }}" value="{{ $item->user_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ip" class="col-sm-3 col-form-label">{{ __('log.ip') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.ip') }}" id="{{ __('log.ip') }}" value="{{ $item->ip }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="level" class="col-sm-3 col-form-label">{{ __('log.level') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.level') }}" id="{{ __('log.level') }}" value="{{ $item->level }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="path" class="col-sm-3 col-form-label">{{ __('log.path') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.path') }}" id="{{ __('log.path') }}" value="{{ $item->path }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="method" class="col-sm-3 col-form-label">{{ __('log.method') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.method') }}" id="{{ __('log.method') }}" value="{{ $item->method }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="action" class="col-sm-3 col-form-label">{{ __('log.action') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.action') }}" id="{{ __('log.action') }}" value="{{ $item->action }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model" class="col-sm-3 col-form-label">{{ __('log.model') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.model') }}" id="{{ __('log.model') }}" value="{{ $item->model }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="model_id" class="col-sm-3 col-form-label">{{ __('log.model_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.model_id') }}" id="{{ __('log.model_id') }}" value="{{ $item->model_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label">{{ __('log.content') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __('log.content') }}" id="{{ __('log.content') }}" value="{{ $item->content }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-foot">
                <a href="{{ route('logs.edit', $item->getKey()) }}" title="编辑" class="btn btn-info">
                    <i class="icon fa fa-edit"></i> 编辑
                </a>
                <a href="{{ route('logs.delete', $item->getKey()) }}" class="btn btn-danger btn-flat btn-sm" title="删除" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                    <i class="icon fa fa-trash"></i> 删除
                </a>
            </div>
            <form id="delete-form" action="{{ route('logs.delete', $item->getKey()) }}" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
@endsection

@extend('layouts.app')

@section('title', "编辑{{ __('log.module') }}")

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('log.module') }}{{ $item->id }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('logs.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label">{{ __('log.user_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('user_id') ? ' is_invalid' : '' }}" name="user_id" id="user_id" placeholder="{{ __('log.user_id') }}" value="{{ old('user_id', $item->user_id) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ip" class="col-sm-3 col-form-label">{{ __('log.ip') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('ip') ? ' is_invalid' : '' }}" name="ip" id="ip" placeholder="{{ __('log.ip') }}" value="{{ old('ip', $item->ip) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">{{ __('log.level') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('level') ? ' is_invalid' : '' }}" name="level" id="level" placeholder="{{ __('log.level') }}" value="{{ old('level', $item->level) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="path" class="col-sm-3 col-form-label">{{ __('log.path') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('path') ? ' is_invalid' : '' }}" name="path" id="path" placeholder="{{ __('log.path') }}" value="{{ old('path', $item->path) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method" class="col-sm-3 col-form-label">{{ __('log.method') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('method') ? ' is_invalid' : '' }}" name="method" id="method" placeholder="{{ __('log.method') }}" value="{{ old('method', $item->method) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="action" class="col-sm-3 col-form-label">{{ __('log.action') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('action') ? ' is_invalid' : '' }}" name="action" id="action" placeholder="{{ __('log.action') }}" value="{{ old('action', $item->action) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model" class="col-sm-3 col-form-label">{{ __('log.model') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('model') ? ' is_invalid' : '' }}" name="model" id="model" placeholder="{{ __('log.model') }}" value="{{ old('model', $item->model) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model_id" class="col-sm-3 col-form-label">{{ __('log.model_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('model_id') ? ' is_invalid' : '' }}" name="model_id" id="model_id" placeholder="{{ __('log.model_id') }}" value="{{ old('model_id', $item->model_id) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label">{{ __('log.content') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('content') ? ' is_invalid' : '' }}" name="content" id="content" rows="5" placeholder="{{ __('log.content') }}">{{ old('content', $item->content) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-foot">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="icon fa fa-save"></i> 保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

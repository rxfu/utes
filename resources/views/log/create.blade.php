@extend('layouts.app')

@section('title', "创建{{ __('log.module') }}")

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">创建{{ __('log.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('logs.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label">{{ __('log.user_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('user_id') ? ' is_invalid' : '' }}" name="user_id" id="user_id" placeholder="{{ __('log.user_id') }}" value="{{ old('user_id') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ip" class="col-sm-3 col-form-label">{{ __('log.ip') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('ip') ? ' is_invalid' : '' }}" name="ip" id="ip" placeholder="{{ __('log.ip') }}" value="{{ old('ip') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label">{{ __('log.level') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('level') ? ' is_invalid' : '' }}" name="level" id="level" placeholder="{{ __('log.level') }}" value="{{ old('level') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="path" class="col-sm-3 col-form-label">{{ __('log.path') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('path') ? ' is_invalid' : '' }}" name="path" id="path" placeholder="{{ __('log.path') }}" value="{{ old('path') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="method" class="col-sm-3 col-form-label">{{ __('log.method') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('method') ? ' is_invalid' : '' }}" name="method" id="method" placeholder="{{ __('log.method') }}" value="{{ old('method') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="action" class="col-sm-3 col-form-label">{{ __('log.action') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('action') ? ' is_invalid' : '' }}" name="action" id="action" placeholder="{{ __('log.action') }}" value="{{ old('action') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model" class="col-sm-3 col-form-label">{{ __('log.model') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('model') ? ' is_invalid' : '' }}" name="model" id="model" placeholder="{{ __('log.model') }}" value="{{ old('model') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model_id" class="col-sm-3 col-form-label">{{ __('log.model_id') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('model_id') ? ' is_invalid' : '' }}" name="model_id" id="model_id" placeholder="{{ __('log.model_id') }}" value="{{ old('model_id') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label">{{ __('log.content') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('content') ? ' is_invalid' : '' }}" name="content" id="content" rows="5" placeholder="{{ __('log.content') }}">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="updated_at" class="col-sm-3 col-form-label">{{ __('log.updated_at') }}</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="updated_at" id="updated_at" class="form-control{{ $errors->has('updated_at']) ? ' is_invalid' : '' }}" placeholder="{{ __('log.updated_at') }}" value="{{ old('updated_at') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
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

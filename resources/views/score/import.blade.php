<form role="form" id="import-form" name="import-form" method="post" action="{{ route('scores.import') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="import" class="col-sm-3 col-form-label text-right">{{ __('score.import') }}</label>
        <div class="col-md-9">
            <input type="file" name="import" id="import" class="form-control{{ $errors->has('import') ? ' is-invalid' : '' }}" placeholder="{{ __('score.import') }}" required>
            @if ($errors->has('import'))
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('import') }}</strong>
                </div>
            @endif
            <small class="form-text text-light">只允许Excel格式文件</small>
        </div>
    </div>
</form>

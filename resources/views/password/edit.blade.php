<form role="form" id="reset-form" name="reset-form" method="post" action="{{ route('passwords.update', $item) }}">
    @csrf
    @method('put')
    <div class="form-group row">
        <label for="password" class="col-sm-3 col-form-label text-right">{{ __('user.password') }}</label>
        <div class="col-md-9">
            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password') }}" required>
            @if ($errors->has('password'))
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
            <small class="form-text text-light">密码至少8位</small>
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-3 col-form-label text-right">{{ __('user.password_confirmation') }}</label>
        <div class="col-md-9">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password_confirmation') }}" required>
            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>
    </div>
</form>

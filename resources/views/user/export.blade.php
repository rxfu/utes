<form role="form" id="export-form" name="export-form" method="post" action="{{ route('users.export') }}">
    @csrf
    <div class="form-group row">
        <label for="year" class="col-sm-3 col-form-label text-right">{{ __('application.year') }}</label>
        <div class="col-md-9">
            <select id="year" name="year" class="form-control select2">
                @foreach ($years as $item)
                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                @endforeach
            </select>
            @if ($errors->has('year'))
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('year') }}</strong>
                </div>
            @endif
        </div>
    </div>
</form>

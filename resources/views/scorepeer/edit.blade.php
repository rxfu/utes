@extends('layouts.app')

@section('title', __('Edit') . __('scorepeer.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('scorepeer.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('scorepeers.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="year" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.year') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" id="year" placeholder="{{ __('scorepeer.year') }}" value="{{ old('year', $item->year) }}">
                            @if ($errors->has('year'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.user_id') }}</label>
                        <div class="col-sm-9">
                            @inject('users', 'App\Services\UserService')
							<select name="user_id" id="user_id" class="form-control select2 select2-info{{ $errors->has('user_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($users->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('user_id', $item->user_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judge_id" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.judge_id') }}</label>
                        <div class="col-sm-9">
                            @inject('judges', 'App\Services\JudgeService')
							<select name="judge_id" id="judge_id" class="form-control select2 select2-info{{ $errors->has('judge_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($judges->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('judge_id', $item->judge_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('judge_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('judge_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.number') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" id="number" placeholder="{{ __('scorepeer.number') }}" value="{{ old('number', $item->number) }}">
                            @if ($errors->has('number'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="score" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.score') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('score') ? ' is-invalid' : '' }}" name="score" id="score" placeholder="{{ __('scorepeer.score') }}" value="{{ old('score', $item->score) }}">
                            @if ($errors->has('score'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('score') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_confirmed" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.is_confirmed') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_confirmed" id="is_confirmed1" class="form-check-input{{ $errors->has('is_confirmed') ? ' is-invalid' : '' }}" value="1"{{ old('is_confirmed', $item->is_confirmed) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_confirmed1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_confirmed" id="is_confirmed0" class="form-check-input{{ $errors->has('is_confirmed') ? ' is-invalid' : '' }}" value="0"{{ old('is_confirmed', $item->is_confirmed) == 0 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_confirmed0">否</label>
                            </div>
                            @if ($errors->has('is_confirmed'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_confirmed') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.course') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" id="course" placeholder="{{ __('scorepeer.course') }}" value="{{ old('course', $item->course) }}">
                            @if ($errors->has('course'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="time" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.time') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" id="time" placeholder="{{ __('scorepeer.time') }}" value="{{ old('time', $item->time) }}">
                            @if ($errors->has('time'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('time') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="classroom" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.classroom') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('classroom') ? ' is-invalid' : '' }}" name="classroom" id="classroom" placeholder="{{ __('scorepeer.classroom') }}" value="{{ old('classroom', $item->classroom) }}">
                            @if ($errors->has('classroom'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('classroom') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="class" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.class') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="class" placeholder="{{ __('scorepeer.class') }}" value="{{ old('class', $item->class) }}">
                            @if ($errors->has('class'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.file') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" id="file" placeholder="{{ __('scorepeer.file') }}" value="{{ old('file', $item->file) }}">
                            @if ($errors->has('file'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" id="remark" rows="5" placeholder="{{ __('scorepeer.remark') }}">{{ old('remark', $item->remark) }}</textarea>
                            @if ($errors->has('remark'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

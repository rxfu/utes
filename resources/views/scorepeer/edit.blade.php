@extends('layouts.app')

@section('title', __('Score'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Score') }}: {{ $item->user->name }}</h3>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>{{ __('scorepeer.course') }}</th>
                    <th>{{ __('scorepeer.time') }}</th>
                    <th>{{ __('scorepeer.classroom') }}</th>
                    <th>{{ __('scorepeer.class') }}</th>
                </tr>
                <tr>
                    <td>{!! $item->user->application->course !!}</td>
                    <td>{!! $item->user->application->time !!}</td>
                    <td>{!! $item->user->application->classroom !!}</td>
                    <td>{!! $item->user->application->class !!}</td>
                </tr>
            </table>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('scorepeers.update', $item) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

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
                        <label for="file" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.file') }}</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" id="file" placeholder="{{ __('scorepeer.file') }}" value="{{ old('file', $item->file) }}">
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

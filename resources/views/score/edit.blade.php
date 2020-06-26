@extends('layouts.app')

@section('title', __('Edit') . __('score.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('score.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('scores.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('score.user_id') }}</label>
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
                        <label for="student1" class="col-sm-3 col-form-label text-right">{{ __('score.student1') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('student1') ? ' is-invalid' : '' }}" name="student1" id="student1" placeholder="{{ __('score.student1') }}" value="{{ old('student1', $item->student1) }}">
                            @if ($errors->has('student1'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('student1') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="plan1" class="col-sm-3 col-form-label text-right">{{ __('score.plan1') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('plan1') ? ' is-invalid' : '' }}" name="plan1" id="plan1" placeholder="{{ __('score.plan1') }}" value="{{ old('plan1', $item->plan1) }}">
                            @if ($errors->has('plan1'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('plan1') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="plan2" class="col-sm-3 col-form-label text-right">{{ __('score.plan2') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('plan2') ? ' is-invalid' : '' }}" name="plan2" id="plan2" placeholder="{{ __('score.plan2') }}" value="{{ old('plan2', $item->plan2) }}">
                            @if ($errors->has('plan2'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('plan2') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="peer1" class="col-sm-3 col-form-label text-right">{{ __('score.peer1') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('peer1') ? ' is-invalid' : '' }}" name="peer1" id="peer1" placeholder="{{ __('score.peer1') }}" value="{{ old('peer1', $item->peer1) }}">
                            @if ($errors->has('peer1'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('peer1') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="peer2" class="col-sm-3 col-form-label text-right">{{ __('score.peer2') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('peer2') ? ' is-invalid' : '' }}" name="peer2" id="peer2" placeholder="{{ __('score.peer2') }}" value="{{ old('peer2', $item->peer2) }}">
                            @if ($errors->has('peer2'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('peer2') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="peer3" class="col-sm-3 col-form-label text-right">{{ __('score.peer3') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('peer3') ? ' is-invalid' : '' }}" name="peer3" id="peer3" placeholder="{{ __('score.peer3') }}" value="{{ old('peer3', $item->peer3) }}">
                            @if ($errors->has('peer3'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('peer3') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expert1" class="col-sm-3 col-form-label text-right">{{ __('score.expert1') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('expert1') ? ' is-invalid' : '' }}" name="expert1" id="expert1" placeholder="{{ __('score.expert1') }}" value="{{ old('expert1', $item->expert1) }}">
                            @if ($errors->has('expert1'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expert1') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expert2" class="col-sm-3 col-form-label text-right">{{ __('score.expert2') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('expert2') ? ' is-invalid' : '' }}" name="expert2" id="expert2" placeholder="{{ __('score.expert2') }}" value="{{ old('expert2', $item->expert2) }}">
                            @if ($errors->has('expert2'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expert2') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expert3" class="col-sm-3 col-form-label text-right">{{ __('score.expert3') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('expert3') ? ' is-invalid' : '' }}" name="expert3" id="expert3" placeholder="{{ __('score.expert3') }}" value="{{ old('expert3', $item->expert3) }}">
                            @if ($errors->has('expert3'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expert3') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expert4" class="col-sm-3 col-form-label text-right">{{ __('score.expert4') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('expert4') ? ' is-invalid' : '' }}" name="expert4" id="expert4" placeholder="{{ __('score.expert4') }}" value="{{ old('expert4', $item->expert4) }}">
                            @if ($errors->has('expert4'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expert4') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="expert5" class="col-sm-3 col-form-label text-right">{{ __('score.expert5') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('expert5') ? ' is-invalid' : '' }}" name="expert5" id="expert5" placeholder="{{ __('score.expert5') }}" value="{{ old('expert5', $item->expert5) }}">
                            @if ($errors->has('expert5'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expert5') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('score.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" id="remark" rows="5" placeholder="{{ __('score.remark') }}">{{ old('remark', $item->remark) }}</textarea>
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

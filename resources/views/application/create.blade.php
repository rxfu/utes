@extends('layouts.app')

@section('title', __('Create') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('application.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('applications.store') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('application.user_id') }}</label>
                        <div class="col-sm-9">
                            @inject('users', 'App\Services\UserService')
							<select name="user_id" id="user_id" class="form-control select2 select2-success{{ $errors->has('user_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                @foreach ($users->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
                        <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('application.gender_id') }}</label>
                        <div class="col-sm-9">
                            @inject('genders', 'App\Services\GenderService')
							<select name="gender_id" id="gender_id" class="form-control select2 select2-success{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                @foreach ($genders->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('gender_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('application.department_id') }}</label>
                        <div class="col-sm-9">
                            @inject('departments', 'App\Services\DepartmentService')
							<select name="department_id" id="department_id" class="form-control select2 select2-success{{ $errors->has('department_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                @foreach ($departments->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('department_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('department_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title_id" class="col-sm-3 col-form-label text-right">{{ __('application.title_id') }}</label>
                        <div class="col-sm-9">
                            @inject('titles', 'App\Services\TitleService')
							<select name="title_id" id="title_id" class="form-control select2 select2-success{{ $errors->has('title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                @foreach ($titles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('title_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="applied_title_id" class="col-sm-3 col-form-label text-right">{{ __('application.applied_title_id') }}</label>
                        <div class="col-sm-9">
                            @inject('appliedTitles', 'App\Services\AppliedTitleService')
							<select name="applied_title_id" id="applied_title_id" class="form-control select2 select2-success{{ $errors->has('applied_title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                @foreach ($appliedTitles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('applied_title_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('applied_title_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_applied_peer" class="col-sm-3 col-form-label text-right">{{ __('application.is_applied_peer') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_applied_peer" id="is_applied_peer1" class="form-check-input{{ $errors->has('is_applied_peer') ? ' is-invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_applied_peer1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_applied_peer" id="is_applied_peer0" class="form-check-input{{ $errors->has('is_applied_peer') ? ' is-invalid' : '' }}" value="0">
                                <label class="form-check-label" for="is_applied_peer0">否</label>
                            </div>
                            @if ($errors->has('is_applied_peer'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_applied_peer') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label text-right">{{ __('application.course') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" id="course" rows="5" placeholder="{{ __('application.course') }}">{{ old('course') }}</textarea>
                            @if ($errors->has('course'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="time" class="col-sm-3 col-form-label text-right">{{ __('application.time') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" id="time" rows="5" placeholder="{{ __('application.time') }}">{{ old('time') }}</textarea>
                            @if ($errors->has('time'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('time') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="classroom" class="col-sm-3 col-form-label text-right">{{ __('application.classroom') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('classroom') ? ' is-invalid' : '' }}" name="classroom" id="classroom" rows="5" placeholder="{{ __('application.classroom') }}">{{ old('classroom') }}</textarea>
                            @if ($errors->has('classroom'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('classroom') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="class" class="col-sm-3 col-form-label text-right">{{ __('application.class') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="class" rows="5" placeholder="{{ __('application.class') }}">{{ old('class') }}</textarea>
                            @if ($errors->has('class'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('application.remark') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" id="remark" rows="5" placeholder="{{ __('application.remark') }}">{{ old('remark') }}</textarea>
                            @if ($errors->has('remark'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-sm-3 col-form-label text-right">{{ __('application.file') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" id="file" placeholder="{{ __('application.file') }}" value="{{ old('file') }}">
                            @if ($errors->has('file'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', __('Edit') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('application.module') }}: {{ $item->user->username }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('applications.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('user.uid') }}</label>
                        <div class="col-md-9">
                            <input type="text" id="uid" name="uid" class="form-control{{ $errors->has('uid') ? ' is-invalid' : '' }}" placeholder="{{ __('user.uid') }}" value="{{ old('uid', $item->user->uid) }}" required>
                            @if ($errors->has('uid'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uid') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name', $item->user->name) }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('user.gender_id') }}</label>
                        <div class="col-sm-9">
                            @inject('genders', 'App\Services\GenderService')
							<select name="gender_id" id="gender_id" class="form-control select2 select2-info{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($genders->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('gender_id', $item->user->gender_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department_id') }}</label>
                        <div class="col-sm-9">
                            @inject('departments', 'App\Services\DepartmentService')
							<select name="department_id" id="department_id" class="form-control select2 select2-info{{ $errors->has('department_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($departments->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('department_id', $item->user->department_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <label for="degree_id" class="col-sm-3 col-form-label text-right">{{ __('application.degree_id') }}</label>
                        <div class="col-sm-9">
                            @inject('degrees', 'App\Services\DegreeService')
                            <select name="degree_id" id="degree_id" class="form-control select2 select2-success{{ $errors->has('degree_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($degrees->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('degree_id', $item->degree_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('degree_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('degree_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('user.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="{{ __('user.phone') }}" value="{{ old('phone', $item->user->phone) }}" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email', $item->user->email) }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title_id" class="col-sm-3 col-form-label text-right">{{ __('application.title_id') }}</label>
                        <div class="col-sm-9">
                            @inject('titles', 'App\Services\TitleService')
                            <select name="title_id" id="title_id" class="form-control select2 select2-success{{ $errors->has('title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($titles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('title_id', $item->title_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                            @inject('appliedTitles', 'App\Services\TitleService')
                            <select name="applied_title_id" id="applied_title_id" class="form-control select2 select2-success{{ $errors->has('applied_title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($appliedTitles->getAppliedTitles() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('applied_title_id', $item->applied_title_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                        <label for="has_course" class="col-sm-3 col-form-label text-right">{{ __('application.has_course') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="has_course" id="has_course1" class="form-check-input{{ $errors->has('has_course') ? ' is-invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="has_course1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="has_course" id="has_course0" class="form-check-input{{ $errors->has('has_course') ? ' is-invalid' : '' }}" value="0">
                                <label class="form-check-label" for="has_course0">否</label>
                            </div>
                            @if ($errors->has('has_course'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('has_course') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_applied_expert" class="col-sm-3 col-form-label text-right">{{ __('application.is_applied_expert') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_applied_expert" id="is_applied_expert1" class="form-check-input{{ $errors->has('is_applied_expert') ? ' is-invalid' : '' }}" value="1" checked>
                                <label class="form-check-label" for="is_applied_expert1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="is_applied_expert" id="is_applied_expert0" class="form-check-input{{ $errors->has('is_applied_expert') ? ' is-invalid' : '' }}" value="0">
                                <label class="form-check-label" for="is_applied_expert0">否</label>
                            </div>
                            @if ($errors->has('is_applied_expert'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_applied_expert') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row" id="block-reason">
                        <label for="reason" class="col-sm-3 col-form-label text-right">{{ __('application.reason') }}</label>
                        <div class="col-sm-9">
                            <select name="reason" id="reason" class="form-control select2 select2-success{{ $errors->has('reason') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success">
                                <option value="1">{{ config('setting.reason.1') }}</option>
                                <option value="2">{{ config('setting.reason.2') }}</option>
                            </select>
                            @if ($errors->has('reason'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('reason') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row" id="block-file1">
                        <label for="file1" class="col-sm-3 col-form-label text-right">{{ __('application.file1') }}</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control{{ $errors->has('file1') ? ' is-invalid' : '' }}" name="file1" id="file1" placeholder="{{ __('application.file1') }}" value="{{ old('file') }}">
                            @if ($errors->has('file'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file1') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row" id="block-file2">
                        <label for="file2" class="col-sm-3 col-form-label text-right">{{ __('application.file2') }}</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control{{ $errors->has('file2') ? ' is-invalid' : '' }}" name="file2" id="file2" placeholder="{{ __('application.file2') }}" value="{{ old('file') }}">
                            @if ($errors->has('file'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file2') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row" id="block-file3">
                        <label for="file3" class="col-sm-3 col-form-label text-right">{{ __('application.file3') }}</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control{{ $errors->has('file3') ? ' is-invalid' : '' }}" name="file3" id="file3" placeholder="{{ __('application.file3') }}" value="{{ old('file') }}">
                            @if ($errors->has('file'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file3') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row" id="block-course">
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
                    
                    <div class="form-group row" id="block-subject">
                        <label for="subject_id" class="col-sm-3 col-form-label text-right">{{ __('application.subject_id') }}</label>
                        <div class="col-sm-9">
                            @inject('subjects', 'App\Services\SubjectService')
                            <select name="subject_id" id="subject_id" class="form-control select2 select2-success{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($subjects->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('subject_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
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
                        <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('application.user_id') }}</label>
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
                        <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('application.gender_id') }}</label>
                        <div class="col-sm-9">
                            @inject('genders', 'App\Services\GenderService')
							<select name="gender_id" id="gender_id" class="form-control select2 select2-info{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($genders->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('gender_id', $item->gender_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
							<select name="department_id" id="department_id" class="form-control select2 select2-info{{ $errors->has('department_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($departments->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('department_id', $item->department_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
							<select name="title_id" id="title_id" class="form-control select2 select2-info{{ $errors->has('title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($titles->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('title_id', $item->title_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                            @inject('appliedTitles', 'App\Services\TitleService')
							<select name="applied_title_id" id="applied_title_id" class="form-control select2 select2-info{{ $errors->has('applied_title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                @foreach ($appliedTitles->getAppliedTitles() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('applied_title_id', $item->applied_title_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
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
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_applied_peer" id="is_applied_peer1" class="form-check-input{{ $errors->has('is_applied_peer') ? ' is-invalid' : '' }}" value="1"{{ old('is_applied_peer', $item->is_applied_peer) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_applied_peer1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="is_applied_peer" id="is_applied_peer0" class="form-check-input{{ $errors->has('is_applied_peer') ? ' is-invalid' : '' }}" value="0"{{ old('is_applied_peer', $item->is_applied_peer) == 0 ? ' checked' : '' }}>
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
                            <textarea class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" id="course" rows="5" placeholder="{{ __('application.course') }}">{{ old('course', $item->course) }}</textarea>
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
                            <textarea class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" id="time" rows="5" placeholder="{{ __('application.time') }}">{{ old('time', $item->time) }}</textarea>
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
                            <textarea class="form-control{{ $errors->has('classroom') ? ' is-invalid' : '' }}" name="classroom" id="classroom" rows="5" placeholder="{{ __('application.classroom') }}">{{ old('classroom', $item->classroom) }}</textarea>
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
                            <textarea class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" id="class" rows="5" placeholder="{{ __('application.class') }}">{{ old('class', $item->class) }}</textarea>
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
                            <textarea class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" id="remark" rows="5" placeholder="{{ __('application.remark') }}">{{ old('remark', $item->remark) }}</textarea>
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
                            <input type="text" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" id="file" placeholder="{{ __('application.file') }}" value="{{ old('file', $item->file) }}">
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

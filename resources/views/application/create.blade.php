@extends('layouts.app')

@section('title', __('Create') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create') . __('application.module') }}</h3>
            </div>

		    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="uid" class="col-sm-3 col-form-label text-right">{{ __('user.uid') }}</label>
                        <div class="col-md-9">
                            <input type="text" id="uid" name="uid" class="form-control{{ $errors->has('uid') ? ' is-invalid' : '' }}" placeholder="{{ __('user.uid') }}" value="{{ old('uid') }}" required>
                            @if ($errors->has('uid'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uid') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-right">{{ __('user.password') }}</label>
                        <div class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('user.password') }}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                            <small class="form-text text-muted">密码至少8位</small>
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
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('user.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('user.name') }}" value="{{ old('name') }}" required>
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
                            <select name="gender_id" id="gender_id" class="form-control select2 select2-success{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
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
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department_id') }}</label>
                        <div class="col-sm-9">
                            @inject('departments', 'App\Services\DepartmentService')
                            <select name="department_id" id="department_id" class="form-control select2 select2-success{{ $errors->has('department_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
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
                        <label for="degree_id" class="col-sm-3 col-form-label text-right">{{ __('application.degree_id') }}</label>
                        <div class="col-sm-9">
                            @inject('degrees', 'App\Services\DegreeService')
                            <select name="degree_id" id="degree_id" class="form-control select2 select2-success{{ $errors->has('degree_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($degrees->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
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
                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="{{ __('user.phone') }}" value="{{ old('phone') }}" required>
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
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="{{ __('user.email') }}" value="{{ old('email') }}" required>
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
                            @inject('appliedTitles', 'App\Services\TitleService')
                            <select name="applied_title_id" id="applied_title_id" class="form-control select2 select2-success{{ $errors->has('applied_title_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-success" required>
                                @foreach ($appliedTitles->getAppliedTitles() as $collection)
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

@push('scripts')
<script>
    $('#block-reason, #block-file1, #block-file2, #block-file3').hide();
    $('#block-course, #block-subject').show();

    $('input[name=is_applied_expert]').change(function() {
        if ($(this).val() == '1') {
            $('#block-reason, #block-file1, #block-file2, #block-file3').hide();
            $('#block-course, #block-subject').show();
        } else if ($(this).val() == 0) {
            $('#block-reason, #block-file1, #block-file2, #block-file3').show();
            $('#block-course, #block-subject').hide();
        }
    })
</script>
@endpush

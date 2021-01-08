@extends('layouts.app')

@section('title', __('Show') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('application.module') }}: {{ $item->user->username }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('application.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('application.user_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{ $item->user->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('user.gender_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="gender_id" id="gender_id" value="{{ optional($item->user->gender)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="department_id" id="department_id" value="{{ optional($item->user->department)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="degree_id" class="col-sm-3 col-form-label text-right">{{ __('application.degree_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="degree_id" id="degree_id" value="{{ optional($item->degree)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-right">{{ __('user.phone') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="phone" id="phone" value="{{ $item->user->phone }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">{{ __('user.email') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="email" id="email" value="{{ $item->user->email }}" readonly>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="title_id" class="col-sm-3 col-form-label text-right">{{ __('application.title_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="title_id" id="title_id" value="{{ optional($item->title)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="applied_title_id" class="col-sm-3 col-form-label text-right">{{ __('application.applied_title_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="applied_title_id" id="applied_title_id" value="{{ optional($item->appliedTitle)->name }}" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="has_course" class="col-sm-3 col-form-label text-right">{{ __('application.has_course') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="has_course" id="has_course" value="{{ $item->present()->hasCourse }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_applied_expert" class="col-sm-3 col-form-label text-right">{{ __('application.is_applied_expert') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_applied_expert" id="is_applied_expert" value="{{ $item->present()->isAppliedExpert }}" readonly>
                    </div>
                </div>

                <div class="form-group row" id="block-reason">
                    <label for="reason" class="col-sm-3 col-form-label text-right">{{ __('application.reason') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="reason" id="reason" value="{{ $item->present()->reason }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-sm-3 col-form-label text-right">{{ __('application.file') }}</label>
                    <div class="col-sm-9">
                        {!! $item->present()->files !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="course" class="col-sm-3 col-form-label text-right">{{ __('application.course') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="course" id="course" value="{!! $item->course !!}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="course" class="col-sm-3 col-form-label text-right">{{ __('application.subject_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="subject_id" id="subject_id" value="{{ optional($item->subject)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="has_course" class="col-sm-3 col-form-label text-right">{{ __('application.is_audit') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_audit" id="is_audit" value="{{ $item->present()->isAudit }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('application.audit_reason') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="audit_reason" id="audit_reason" value="{{ $item->audit_reason }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('application.remark') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="remark" id="remark" value="{{ $item->remark }}" readonly>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('applications.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('applications.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </a>
                    @endcan
                </div>
            </div>
            @can('delete', $item)
                <form id="delete-form" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection

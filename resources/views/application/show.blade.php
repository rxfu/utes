@extends('layouts.app')

@section('title', __('Show') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('application.module') }}: {{ $item->getKey() }}</h3>
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
                        <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{ $item->user_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender_id" class="col-sm-3 col-form-label text-right">{{ __('application.gender_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="gender_id" id="gender_id" value="{{ $item->gender_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('application.department_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="department_id" id="department_id" value="{{ $item->department_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title_id" class="col-sm-3 col-form-label text-right">{{ __('application.title_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="title_id" id="title_id" value="{{ $item->title_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="applied_title_id" class="col-sm-3 col-form-label text-right">{{ __('application.applied_title_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="applied_title_id" id="applied_title_id" value="{{ $item->applied_title_id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_applied_peer" class="col-sm-3 col-form-label text-right">{{ __('application.is_applied_peer') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_applied_peer" id="is_applied_peer" value="{{ $item->is_applied_peer }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="course" class="col-sm-3 col-form-label text-right">{{ __('application.course') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="course" id="course" value="{{ $item->course }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="time" class="col-sm-3 col-form-label text-right">{{ __('application.time') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="time" id="time" value="{{ $item->time }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="classroom" class="col-sm-3 col-form-label text-right">{{ __('application.classroom') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="classroom" id="classroom" value="{{ $item->classroom }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="class" class="col-sm-3 col-form-label text-right">{{ __('application.class') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="class" id="class" value="{{ $item->class }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('application.remark') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="remark" id="remark" value="{{ $item->remark }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-sm-3 col-form-label text-right">{{ __('application.file') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="file" id="file" value="{{ $item->file }}" readonly>
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

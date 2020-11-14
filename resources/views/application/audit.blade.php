@extends('layouts.app')

@section('title', __('Audit') . __('application.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Audit') . __('application.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="audit-form" name="audit-form" method="post" action="{{ route('applications.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">

                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('application.user_id') }}</label>
                        <div class="col-sm-9">
                            <span class="form-control-plaintext">{{ $item->user->name }}</span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department_id') }}</label>
                        <div class="col-sm-9">
                            <span class="form-control-plaintext">{{ optional($item->user->department)->name }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_audit" class="col-sm-3 col-form-label text-right">{{ __('application.is_audit') }}</label>
                        <div class="col-sm-9">
                            <div class="icheck-warning icheck-inline">
                                <input type="radio" name="is_audit" id="is_audit1" class="form-check-input{{ $errors->has('is_audit') ? ' is-invalid' : '' }}" value="1"{{ old('is_audit', $item->is_audit) == 1 || empty($item->is_audit) ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_audit1">通过</label>
                            </div>
                            <div class="icheck-warning icheck-inline">
                                <input type="radio" name="is_audit" id="is_audit2" class="form-check-input{{ $errors->has('is_audit') ? ' is-invalid' : '' }}" value="2"{{ old('is_audit', $item->is_audit) == 2 ? ' checked' : '' }}>
                                <label class="form-check-label" for="is_audit2">不通过</label>
                            </div>
                            @if ($errors->has('is_audit'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_audit') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="audit_reason" class="col-sm-3 col-form-label text-right">{{ __('application.audit_reason') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('audit_reason') ? ' is-invalid' : '' }}" name="audit_reason" id="audit_reason" rows="5" placeholder="{{ __('application.audit_reason') }}">{{ old('audit_reason', $item->audit_reason) }}</textarea>
                            @if ($errors->has('audit_reason'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('audit_reason') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> {{ __('Save') . __('Audit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
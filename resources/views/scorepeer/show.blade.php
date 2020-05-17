@extends('layouts.app')

@section('title', __('Show') . __('scorepeer.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('scorepeer.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="year" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.year') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="year" id="year" value="{{ $item->year }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.user_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{ optional($item->user)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judge_id" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.judge_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="judge_id" id="judge_id" value="{{ optional($item->judge)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.number') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="number" id="number" value="{{ $item->number }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="score" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.score') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="score" id="score" value="{{ $item->score }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_confirmed" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.is_confirmed') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="is_confirmed" id="is_confirmed" value="{{ $item->is_confirmed }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="course" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.course') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="course" id="course" value="{{ $item->course }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="time" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.time') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="time" id="time" value="{{ $item->time }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="classroom" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.classroom') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="classroom" id="classroom" value="{{ $item->classroom }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="class" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.class') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="class" id="class" value="{{ $item->class }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.file') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="file" id="file" value="{{ $item->file }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.remark') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="remark" id="remark" value="{{ $item->remark }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('scorepeers.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('scorepeers.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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

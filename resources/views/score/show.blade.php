@extends('layouts.app')

@section('title', __('Show') . __('score.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Show') . __('score.module') }}: {{ $item->getKey() }}</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group row">
                    <label for="id" class="col-sm-3 col-form-label text-right">{{ __('score.id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="id" id="id" value="{{ $item->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="year" class="col-sm-3 col-form-label text-right">{{ __('score.year') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="year" id="year" value="{{ $item->year }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label text-right">{{ __('score.user_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{ optional($item->user)->name }}" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label text-right">{{ __('user.department_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="department_id" id="department_id" value="{{ optional($item->user->department)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="student1" class="col-sm-3 col-form-label text-right">{{ __('score.student1') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="student1" id="student1" value="{{ $item->student1 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="plan1" class="col-sm-3 col-form-label text-right">{{ __('score.plan1') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="plan1" id="plan1" value="{{ $item->plan1 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="plan2" class="col-sm-3 col-form-label text-right">{{ __('score.plan2') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="plan2" id="plan2" value="{{ $item->plan2 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="peer1" class="col-sm-3 col-form-label text-right">{{ __('score.peer1') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="peer1" id="peer1" value="{{ $item->peer1 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="peer2" class="col-sm-3 col-form-label text-right">{{ __('score.peer2') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="peer2" id="peer2" value="{{ $item->peer2 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="peer3" class="col-sm-3 col-form-label text-right">{{ __('score.peer3') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="peer3" id="peer3" value="{{ $item->peer3 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expert1" class="col-sm-3 col-form-label text-right">{{ __('score.expert1') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="expert1" id="expert1" value="{{ $item->expert1 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expert2" class="col-sm-3 col-form-label text-right">{{ __('score.expert2') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="expert2" id="expert2" value="{{ $item->expert2 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expert3" class="col-sm-3 col-form-label text-right">{{ __('score.expert3') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="expert3" id="expert3" value="{{ $item->expert3 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expert4" class="col-sm-3 col-form-label text-right">{{ __('score.expert4') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="expert4" id="expert4" value="{{ $item->expert4 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expert5" class="col-sm-3 col-form-label text-right">{{ __('score.expert5') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="expert5" id="expert5" value="{{ $item->expert5 }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="creator_id" class="col-sm-3 col-form-label text-right">{{ __('score.creator_id') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="creator_id" id="creator_id" value="{{ optional($item->creator)->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label text-right">{{ __('score.remark') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="remark" id="remark" value="{{ $item->remark }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    @can('update', $item)
                        <a href="{{ route('scores.edit', $item) }}" title="{{ __('Edit') }}" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    &nbsp;&nbsp;
                    @can('delete', $item)
                        <a href="{{ route('scores.destroy', $item) }}" class="btn btn-danger delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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

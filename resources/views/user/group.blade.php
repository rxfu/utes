@extends('layouts.app')

@section('title', __('Assign Group'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Assign Group') }}: {{ $item->username }}</h3>
            </div>

		    <form role="form" id="assign-form" name="assign-form" method="post" action="{{ route('users.group', $item->getKey()) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="groups" class="col-sm-3 col-form-label text-right">{{ __('group.module') }}</label>
                        <div class="col-sm-9">
                            @inject('groups', 'App\Services\GroupService')
                            @foreach ($groups->getAll() as $item)
                                <div class="icheck-success icheck-inline">
                                    <input type="checkbox" name="groups[]" id="group{{ $loop->index }}" class="form-check-input{{ $errors->has('groups[]') ? ' is-invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $assignedGroups) ? ' checked' : '' }}>
                                    <label class="form-check-label" for="group{{ $loop->index }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            @if ($errors->has('groups[]'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('groups[]') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

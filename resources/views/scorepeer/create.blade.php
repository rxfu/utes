@extends('layouts.app')

@section('title', __('Assign Teacher'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Assign Teacher') }}: {{ $item->username }}</h3>
            </div>

		    <form role="form" id="assign-form" name="assign-form" method="post" action="{{ route('scorepeers.store', $item->getKey()) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="teachers" class="col-sm-3 col-form-label text-right">{{ __('scorepeer.user_id') }}</label>
                        <div class="col-sm-9">
                            <div class="row">
                                @inject('user', 'App\Services\UserService')
                                @foreach ($user->getUsersByRole('teacher') as $item)
                                <div class="col-sm-2">
                                    <div class="icheck-success icheck-inline">
                                        <input type="checkbox" name="teachers[]" id="teacher{{ $loop->index }}" class="form-check-input{{ $errors->has('teachers[]') ? ' is-invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $assignedTeachers) ? ' checked' : '' }}>
                                        <label class="form-check-label" for="teacher{{ $loop->index }}">{{ $item->name }}</label>
                                    </div>
                                </div>
                                @endforeach
                                @if ($errors->has('teachers[]'))
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('teachers[]') }}</strong>
                                    </div>
                                @endif
                            </div>
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

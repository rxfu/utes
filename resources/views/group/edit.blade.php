@extends('layouts.app')

@section('title', __('Edit') . __('group.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit') . __('group.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('groups.update', $item) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="slug" class="col-sm-3 col-form-label text-right">{{ __('group.slug') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" placeholder="{{ __('group.slug') }}" value="{{ old('slug', $item->slug) }}">
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-right">{{ __('group.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="{{ __('group.name') }}" value="{{ old('name', $item->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number" class="col-sm-3 col-form-label text-right">{{ __('group.number') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" id="number" placeholder="{{ __('group.number') }}" value="{{ old('number', $item->number) }}">
                            @if ($errors->has('number'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label text-right">{{ __('group.parent_id') }}</label>
                        <div class="col-sm-9">
                            @inject('groups', 'App\Services\GroupService')
							<select name="parent_id" id="parent_id" class="form-control select2 select2-info{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" data-dropdown-css-class="select2-info">
                                <option value=""{{ old('parent_id', $item->parent_id) === '' ? ' selected' : '' }}>无</option>
                                @foreach ($groups->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old('parent_id', $item->parent_id) === $collection->getKey() ? ' selected' : '' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label text-right">{{ __('group.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="5" placeholder="{{ __('group.description') }}">{{ old('description', $item->description) }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
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

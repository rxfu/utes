@extends('layouts.app')

@section('title', '编辑' . __('password.module'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">编辑{{ __('password.module') }}: {{ $item->getKey() }}</h3>
            </div>

		    <form role="form" id="edit-form" name="edit-form" method="post" action="{{ route('passwords.update', $item->getKey()) }}">
                @csrf
                @method('put')
                <div class="card-body">
                    
                </div>

                <div class="card-footer">
                    <div class="row justify-content-sm-center">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> 保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

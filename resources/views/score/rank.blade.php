@extends('layouts.app')

@section('title', '总成绩排行榜')

@section('content')
<form role="form" id="select-form" name="select-form" method="get" action="{{ route('scores.rank') }}">
    <div class="form-group row justify-content-center">
        <label for="year" class="col-sm-3 col-form-label text-right">选择年度</label>
        <div class="col-sm-3">
            <select id="year" name="year" class="form-control select2{{ $errors->has('year') ? ' is-invalid' : '' }}">
                @foreach ($years as $item)
                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                @endforeach
            </select>
            @if ($errors->has('year'))
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('year') }}</strong>
                </div>
            @endif
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">确定</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ request('year') ? request('year') . '年度' : '' }}总成绩排行榜</h3>
                <div class="card-tools">
                    @can('import', User::class)
                        <a href="{{ route('scores.export-rank', request('year')) }}" title="{{ __('Export') }}" class="btn btn-secondary">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('score.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                @include('exports.rank', compact('items'))
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', '总成绩排行榜')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">总成绩排行榜</h3>
                <div class="card-tools">
                    @can('import', User::class)
                        <a href="{{ route('scores.export-rank') }}" title="{{ __('Export') }}" class="btn btn-secondary">
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

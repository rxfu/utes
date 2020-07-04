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
                        <a href="{{ route('scores.export') }}" title="{{ __('Export') }}" class="btn btn-secondary">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('score.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="scores-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>名次</th>
                            <th>学院</th>
							<th>姓名</th>
							<th>学生评价成绩</th>
							<th>教案评价成绩</th>
							<th>同行评价成绩</th>
							<th>专家评价成绩</th>
							<th>总成绩</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['department'] }}</td>
                                <td>
                                    <a href="{{ route('scores.show', $item['id']) }}" title="成绩明细">{{ $item['name'] }}</a></td>
                                <td>{{ $item['student'] }}</td>
                                <td>{{ $item['plan'] }}</td>
                                <td>{{ $item['peer'] }}</td>
                                <td>{{ $item['expert'] }}</td>
                                <td>{{ $item['total'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>名次</th>
                            <th>学院</th>
							<th>姓名</th>
							<th>学生评价成绩</th>
							<th>教案评价成绩</th>
							<th>同行评价成绩</th>
							<th>专家评价成绩</th>
							<th>总成绩</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

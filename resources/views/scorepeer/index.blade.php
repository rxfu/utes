@extends('layouts.app')

@section('title', __('scorepeer.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('scorepeer.module') . __('List') }}</h3>
                <div class="card-tools">
                    @unless ($items->filter(function($item) {
                        return $item->is_confirmed == false;
                    })->isEmpty())
                        @can('update', $items[0])
                            <a href="{{ route('scorepeers.confirm') }}" title="{{ __('Confirm') . __('Score') }}" class="btn btn-success confirm" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Score') }}">
                                <i class="fas fa-check-double"></i> {{ __('Confirm') . __('Score') }}
                            </a>
                        @endcan
                    @endunless
                </div>
            </div>

            <div class="card-body">
                <table id="scorepeers-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items->groupBy('user_id') as $users)
                            @foreach ($users as $item)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ $users->count() }}" style="vertical-align: middle">{{ $item->id }}</td>
                                        <td rowspan="{{ $users->count() }}" style="vertical-align: middle">{{ $item->year }}</td>
                                        <td rowspan="{{ $users->count() }}" style="vertical-align: middle">{{ $item->judge->name }}</td>
                                        <td rowspan="{{ $users->count() }}" style="vertical-align: middle">{{ $item->user->name }}</td>
                                    @endif
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->course }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>{{ $item->classroom }}</td>
                                    <td>{{ $item->class }}</td>
                                    <td>{{ $item->score }}</td>
                                    <td>{!! $item->present()->image !!}</td>
                                    <td>{{ $item->present()->isConfirmed }}</td>
                                    <td>
                                        @unless ($item->is_confirmed)
                                            @can('update', $item)
                                                <a href="{{ route('scorepeers.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Score') }}">
                                                    <i class="fas fa-edit"></i> {{ __('Score') }}{{ $loop->iteration }}
                                                </a>
                                            @endcan
                                        @endunless
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!--script>
	$('#scorepeers-table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('plugins/datatables/lang/Chinese.json') }}"
        },
        'rowsGroup': [0, 1, 2, 3]
    });
</script-->
@endpush

@extends('layouts.app')

@section('title', __('score.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('score.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('import', Score::class)
                        <a href="{{ route('scores.export') }}" title="{{ __('Export') }}" class="btn btn-secondary">
                            <i class="fas fa-file-export"></i> {{ __('Export') . __('score.module') }}
                        </a>
                        <a href="{{ route('scores.import') }}" title="{{ __('Import') }}" class="btn btn-info import" data-toggle="modal" data-target="#dialog" data-whatever="{{  __('score.module') . __('import') }}
                    ">
                            <i class="fas fa-file-import"></i> {{ __('Import') . __('score.module') }}
                        </a>
                    @endcan
                    @can('create', Score::class)
                        <a href="{{ route('scores.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fas fa-plus"></i> {{ __('Create') . __('score.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="scores-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('score.id') }}</th>
							<th>{{ __('score.year') }}</th>
							<th>{{ __('score.user_id') }}</th>
							<th>{{ __('application.department_id') }}</th>
							<th>{{ __('score.student1') }}</th>
							<th>{{ __('score.plan1') }}</th>
							<th>{{ __('score.plan2') }}</th>
							<th>{{ __('score.peer1') }}</th>
							<th>{{ __('score.peer2') }}</th>
							<th>{{ __('score.peer3') }}</th>
							<th>{{ __('score.expert1') }}</th>
							<th>{{ __('score.expert2') }}</th>
							<th>{{ __('score.expert3') }}</th>
							<th>{{ __('score.expert4') }}</th>
							<th>{{ __('score.expert5') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->year }}</td>
								<td>{{ optional($item->user)->name }}</td>
								<td>{{ optional($item->user->application->department)->name }}</td>
								<td>{{ $item->student1 }}</td>
								<td>{{ $item->plan1 }}</td>
								<td>{{ $item->plan2 }}</td>
								<td>{{ $item->peer1 }}</td>
								<td>{{ $item->peer2 }}</td>
								<td>{{ $item->peer3 }}</td>
								<td>{{ $item->expert1 }}</td>
								<td>{{ $item->expert2 }}</td>
								<td>{{ $item->expert3 }}</td>
								<td>{{ $item->expert4 }}</td>
								<td>{{ $item->expert5 }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('scores.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('scores.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('scores.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('score.id') }}</th>
							<th>{{ __('score.year') }}</th>
							<th>{{ __('score.user_id') }}</th>
							<th>{{ __('application.department_id') }}</th>
							<th>{{ __('score.student1') }}</th>
							<th>{{ __('score.plan1') }}</th>
							<th>{{ __('score.plan2') }}</th>
							<th>{{ __('score.peer1') }}</th>
							<th>{{ __('score.peer2') }}</th>
							<th>{{ __('score.peer3') }}</th>
							<th>{{ __('score.expert1') }}</th>
							<th>{{ __('score.expert2') }}</th>
							<th>{{ __('score.expert3') }}</th>
							<th>{{ __('score.expert4') }}</th>
							<th>{{ __('score.expert5') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @isset($items[0])
                @can('delete', $items[0])
                    <form id="delete-form" method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                @endcan
            @endisset
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
	$('#scores-table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('plugins/datatables/lang/Chinese.json') }}"
        }
    });
</script>
@endpush

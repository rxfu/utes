@extends('layouts.app')

@section('title', __('scorepeer.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('scorepeer.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Scorepeer::class)
                        <a href="{{ route('scorepeers.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fas fa-plus"></i> {{ __('Create') . __('scorepeer.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="scorepeers-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.remark') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->year }}</td>
								<td>{{ optional($item->user)->name }}</td>
								<td>{{ optional($item->judge)->name }}</td>
								<td>{{ $item->number }}</td>
								<td>{{ $item->score }}</td>
								<td>{{ $item->is_confirmed }}</td>
								<td>{{ $item->course }}</td>
								<td>{{ $item->time }}</td>
								<td>{{ $item->classroom }}</td>
								<td>{{ $item->class }}</td>
								<td>{{ $item->file }}</td>
								<td>{{ $item->remark }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('scorepeers.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('scorepeers.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('scorepeers.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.remark') }}</th>
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
	$('#scorepeers-table').DataTable({
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

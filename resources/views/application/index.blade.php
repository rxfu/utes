@extends('layouts.app')

@section('title', __('application.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('application.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Application::class)
                        <a href="{{ route('applications.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fas fa-plus"></i> {{ __('Create') . __('application.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="applications-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('application.id') }}</th>
							<th>{{ __('application.user_id') }}</th>
							<th>{{ __('application.gender_id') }}</th>
							<th>{{ __('application.department_id') }}</th>
							<th>{{ __('application.title_id') }}</th>
							<th>{{ __('application.applied_title_id') }}</th>
							<th>{{ __('application.course') }}</th>
							<th>{{ __('application.time') }}</th>
							<th>{{ __('application.classroom') }}</th>
							<th>{{ __('application.class') }}</th>
							<th>{{ __('application.remark') }}</th>
							<th>{{ __('application.file') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->user->name }}</td>
								<td>{{ optional($item->gender)->name }}</td>
								<td>{{ $item->department->name }}</td>
								<td>{{ optional($item->title)->name }}</td>
								<td>{{ optional($item->appliedTitle)->name }}</td>
								<td>{!! $item->course !!}</td>
								<td>{!! $item->time !!}</td>
								<td>{!! $item->classroom !!}</td>
								<td>{!! $item->class !!}</td>
								<td>{{ $item->remark }}</td>
								<td>{{ $item->file }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('applications.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('applications.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('applications.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('application.id') }}</th>
							<th>{{ __('application.user_id') }}</th>
							<th>{{ __('application.gender_id') }}</th>
							<th>{{ __('application.department_id') }}</th>
							<th>{{ __('application.title_id') }}</th>
							<th>{{ __('application.applied_title_id') }}</th>
							<th>{{ __('application.course') }}</th>
							<th>{{ __('application.time') }}</th>
							<th>{{ __('application.classroom') }}</th>
							<th>{{ __('application.class') }}</th>
							<th>{{ __('application.remark') }}</th>
							<th>{{ __('application.file') }}</th>
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
	$('#applications-table').DataTable({
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

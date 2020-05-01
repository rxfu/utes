@extends('layouts.app')

@section('title', __('permission.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('permission.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Permission::class)
                        <a href="{{ route('permissions.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fa fa-plus"></i> {{ __('Create') . __('permission.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="permissions-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('permission.id') }}</th>
							<th>{{ __('permission.slug') }}</th>
							<th>{{ __('permission.name') }}</th>
							<th>{{ __('permission.by_group') }}</th>
							<th>{{ __('permission.parent_id') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->slug }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->present()->byGroup }}</td>
								<td>{{ optional($item->parent)->name }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('permissions.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('permissions.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('permissions.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('permission.id') }}</th>
							<th>{{ __('permission.slug') }}</th>
							<th>{{ __('permission.name') }}</th>
							<th>{{ __('permission.by_group') }}</th>
							<th>{{ __('permission.parent_id') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @can('delete', $items[0])
                <form id="delete-form" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
	$('#permissions-table').DataTable({
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

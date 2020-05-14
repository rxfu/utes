@extends('layouts.app')

@section('title', __('grade.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('grade.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Grade::class)
                        <a href="{{ route('grades.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fa fa-plus"></i> {{ __('Create') . __('grade.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="grades-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('grade.id') }}</th>
							<th>{{ __('grade.slug') }}</th>
							<th>{{ __('grade.name') }}</th>
							<th>{{ __('grade.max_score') }}</th>
							<th>{{ __('grade.min_score') }}</th>
							<th>{{ __('grade.description') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->slug }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->max_score }}</td>
								<td>{{ $item->min_score }}</td>
								<td>{{ $item->description }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('grades.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @can('update', $item)
                                        <a href="{{ route('grades.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('delete', $item)
                                        <a href="{{ route('grades.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('grade.id') }}</th>
							<th>{{ __('grade.slug') }}</th>
							<th>{{ __('grade.name') }}</th>
							<th>{{ __('grade.max_score') }}</th>
							<th>{{ __('grade.min_score') }}</th>
							<th>{{ __('grade.description') }}</th>
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
	$('#grades-table').DataTable({
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

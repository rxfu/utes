@extends('layouts.app')

@section('title', __('menu.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menu.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Menu::class)
                        <a href="{{ route('menus.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create') . __('menu.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="menus-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('menu.id') }}</th>
							<th>{{ __('menu.slug') }}</th>
							<th>{{ __('menu.name') }}</th>
							<th>{{ __('menu.is_enable') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->slug }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->present()->isEnable }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('menus.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @unless ($item->is_system)
                                        @can('update', $item)
                                            <a href="{{ route('menus.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            <a href="{{ route('menus.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                                <i class="fas fa-trash"></i> {{ __('Delete') }}
                                            </a>
                                        @endcan
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('menu.id') }}</th>
							<th>{{ __('menu.slug') }}</th>
							<th>{{ __('menu.name') }}</th>
							<th>{{ __('menu.is_enable') }}</th>
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
	$('#menus-table').DataTable({
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

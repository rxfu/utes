@extends('layouts.app')

@section('title', __('menuitem.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menuitem.module') . __('List') }}</h3>
                <div class="card-tools">
                    @can('create', Menuitem::class)
                        <a href="{{ route('menuitems.create') }}" title="{{ __('Create') }}" class="btn btn-success">
                            <i class="icon fa fa-plus"></i> {{ __('Create') . __('menuitem.module') }}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <table id="menuitems-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('menuitem.id') }}</th>
							<th>{{ __('menuitem.slug') }}</th>
							<th>{{ __('menuitem.name') }}</th>
							<th>{{ __('menuitem.route') }}</th>
							<th>{{ __('menuitem.parent_id') }}</th>
							<th>{{ __('menuitem.menu_id') }}</th>
							<th>{{ __('menuitem.is_enable') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->slug }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->route }}</td>
								<td>{{ optional($item->parent)->name }}</td>
								<td>{{ optional($item->menu)->name }}</td>
								<td>{{ $item->present()->isEnable }}</td>
                                <td>
                                    @can('view', $item)
                                        <a href="{{ route('menuitems.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                            <i class="fas fa-folder"></i> {{ __('Show') }}
                                        </a>
                                    @endcan
                                    @unless($item->is_system)
                                        @can('update', $item)
                                            <a href="{{ route('menuitems.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            <a href="{{ route('menuitems.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
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
                            <th>{{ __('menuitem.id') }}</th>
							<th>{{ __('menuitem.slug') }}</th>
							<th>{{ __('menuitem.name') }}</th>
							<th>{{ __('menuitem.route') }}</th>
							<th>{{ __('menuitem.parent_id') }}</th>
							<th>{{ __('menuitem.menu_id') }}</th>
							<th>{{ __('menuitem.is_enable') }}</th>
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
	$('#menuitems-table').DataTable({
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

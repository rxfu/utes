@extends('layouts.app')

@section('title', __('menu.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menu.module') . __('List') }}</h3>
                <div class="card-tools">
                    <a href="{{ route('menus.create') }}" title="创建" class="btn btn-success">
                        <i class="icon fa fa-plus"></i> {{ __('Create') . __('menu.module') }}
                    </a>
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
                                    <a href="{{ route('menus.show', $item) }}" class="btn btn-primary btn-sm" title="{{ __('Show') }}">
                                        <i class="fas fa-folder"></i> {{ __('Show') }}
                                    </a>
                                    @unless ($item->is_system)
                                        <a href="{{ route('menus.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </a>
                                        <a href="{{ route('menus.destroy', $item) }}" class="btn btn-danger btn-sm delete" title="{{ __('Delete') }}" data-toggle="modal" data-target="#dialog" data-whatever="{{ __('Confirm') . __('Delete') }}">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </a>
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
            <form id="delete-form" method="post" style="display: none;">
                @csrf
                @method('delete')
            </form>
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

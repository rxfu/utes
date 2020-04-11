@extends('layouts.app')

@section('title', __('menu.module') . '列表')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menu.module') }}列表</h3>
                <div class="card-tools">
                    <a href="{{ route('menus.create') }}" title="创建" class="btn btn-success">
                        <i class="icon fa fa-plus"></i> 创建{{ __('menu.module') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="menus-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('menu.id') }}</th>
							<th>{{ __('menu.uid') }}</th>
							<th>{{ __('menu.name') }}</th>
							<th>{{ __('menu.is_enable') }}</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->uid }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->present()->isEnable }}</td>
                                <td>
                                    <a href="{{ route('menus.show', $item->getKey()) }}" class="btn btn-primary btn-sm" title="显示">
                                        <i class="fas fa-folder"></i> 显示
                                    </a>
                                    @unless ($item->is_system)
                                        <a href="{{ route('menus.edit', $item->getKey()) }}" class="btn btn-info btn-sm" title="编辑">
                                            <i class="fas fa-pencil-alt"></i> 编辑
                                        </a>
                                        <a href="{{ route('menus.destroy', $item->getKey()) }}" class="btn btn-danger btn-sm delete" title="删除">
                                            <i class="fas fa-trash"></i> 删除
                                        </a>
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>{{ __('menu.id') }}</th>
							<th>{{ __('menu.uid') }}</th>
							<th>{{ __('menu.name') }}</th>
							<th>{{ __('menu.is_enable') }}</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <form id="delete-form" method="POST" style="display: none;">
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

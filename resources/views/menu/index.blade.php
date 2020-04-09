@extend('layouts.app')

@section('title', "{{ __('menu.module') }}列表")

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menu.module') }}列表</h3>
            </div>

            <div class="card-body">
                <table id="{{ modelVariable }}-table" class="table table-bordered table-striped datatable">
                    <tr>
                        <th>{{ __('menu.uid') }}</th>
						<th>{{ __('menu.name') }}</th>
						<th>{{ __('menu.description') }}</th>
						<th>{{ __('menu.is_enable') }}</th>
                        <th colspan="2">操作</th>
                    </tr>
                </table>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->uid }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->description }}</td>
							<td>{{ $item->is_enable }}</td>
                            <td>
                                <a href="{{ route('menus.edit', $item->getKey()) }}" class="btn btn-info btn-flat btn-sm" title="编辑">
                                    <i class="icon fa fa-edit"></i> 编辑
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('menus.delete', $item->getKey()) }}" class="btn btn-danger btn-flat btn-sm" title="删除" onclick="event.preventDefault();document.getElementById('delete-form').action='{{ route('menus.delete', $item->getKey()) }}';document.getElementById('delete-form').submit();">
                                    <i class="icon fa fa-trash"></i> 删除
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </div>
            <form id="delete-form" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>

            <div class="card-foot">
                <a href="{{ route('menus.create') }}" title="创建" class="btn btn-success">
                    <i class="icon fa fa-plus"></i> 创建{{ __('menu.module') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

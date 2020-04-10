@extends('layouts.app')

@section('title', __('menuitem.module') . '列表')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('menuitem.module') }}列表</h3>
            </div>

            <div class="card-body">
                <table id="menuitems-table" class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th>{{ __('menuitem.uid') }}</th>
							<th>{{ __('menuitem.name') }}</th>
							<th>{{ __('menuitem.route') }}</th>
							<th>{{ __('menuitem.icon') }}</th>
							<th>{{ __('menuitem.parent_id') }}</th>
							<th>{{ __('menuitem.menu_id') }}</th>
							<th>{{ __('menuitem.description') }}</th>
							<th>{{ __('menuitem.is_enable') }}</th>
							<th>{{ __('menuitem.order') }}</th>
							<th>{{ __('menuitem.forbidden_delete') }}</th>
                            <th colspan="2">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->uid }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->route }}</td>
								<td>{{ $item->icon }}</td>
								<td>{{ $item->parent_id }}</td>
								<td>{{ $item->menu_id }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->is_enable }}</td>
								<td>{{ $item->order }}</td>
								<td>{{ $item->forbidden_delete }}</td>
                                <td>
                                    <a href="{{ route('menuitems.edit', $item->getKey()) }}" class="btn btn-info btn-flat btn-sm" title="编辑">
                                        <i class="icon fa fa-edit"></i> 编辑
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('menuitems.destroy', $item->getKey()) }}" class="btn btn-danger btn-flat btn-sm" title="删除" onclick="event.preventDefault();document.getElementById('delete-form').action='{{ route('menuitems.destroy', $item->getKey()) }}';document.getElementById('delete-form').submit();">
                                        <i class="icon fa fa-trash"></i> 删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form id="delete-form" method="POST" style="display: none;">
                @csrf
                @method('delete')
            </form>

            <div class="card-foot">
                <div class="row">
                    <div class="col text-right">
                        <a href="{{ route('menuitems.create') }}" title="创建" class="btn btn-success">
                            <i class="icon fa fa-plus"></i> 创建{{ __('menuitem.module') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

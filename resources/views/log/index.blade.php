@extend('layouts.app')

@section('title', 'Log 列表')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Log 列表</h3>
            </div>

            <div class="card-body">
                <table id="logs-table" class="table table-bordered table-striped datatable">
                    <tr>
                        <th>{{ __('Log.user_id') }}</th>
						<th>{{ __('Log.ip') }}</th>
						<th>{{ __('Log.level') }}</th>
						<th>{{ __('Log.path') }}</th>
						<th>{{ __('Log.method') }}</th>
						<th>{{ __('Log.action') }}</th>
						<th>{{ __('Log.model') }}</th>
						<th>{{ __('Log.model_id') }}</th>
						<th>{{ __('Log.content') }}</th>
                        <th colspan="2">操作</th>
                    </tr>
                </table>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->user_id }}</td>
							<td>{{ $item->ip }}</td>
							<td>{{ $item->level }}</td>
							<td>{{ $item->path }}</td>
							<td>{{ $item->method }}</td>
							<td>{{ $item->action }}</td>
							<td>{{ $item->model }}</td>
							<td>{{ $item->model_id }}</td>
							<td>{{ $item->content }}</td>
                            <td>
                                <a href="{{ route('logs.edit', $item->getKey()) }}" class="btn btn-info btn-flat btn-sm" title="编辑">
                                    <i class="icon fa fa-edit"></i> 编辑
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('logs.delete', $item->getKey()) }}" class="btn btn-danger btn-flat btn-sm" title="删除" onclick="event.preventDefault();document.getElementById('delete-form').action='{{ route('logs.delete', $item->getKey()) }}';document.getElementById('delete-form').submit();">
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
                <a href="{{ route('logs.create') }}" title="创建" class="btn btn-success">
                    <i class="icon fa fa-plus"></i> 创建 Log
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

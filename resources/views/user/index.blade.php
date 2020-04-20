@extends('layouts.app')

@section('title', __('user.module') . '列表')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('user.module') }}列表</h3>
                <div class="card-tools">
                    <a href="{{ route('users.create') }}" title="创建" class="btn btn-success">
                        <i class="icon fa fa-plus"></i> 创建{{ __('user.module') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="users-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('user.id') }}</th>
							<th>{{ __('user.username') }}</th>
							<th>{{ __('user.password') }}</th>
							<th>{{ __('user.name') }}</th>
							<th>{{ __('user.email') }}</th>
							<th>{{ __('user.email_verified_at') }}</th>
							<th>{{ __('user.is_enable') }}</th>
							<th>{{ __('user.is_super') }}</th>
							<th>{{ __('user.last_login_at') }}</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->username }}</td>
								<td>{{ $item->password }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->email }}</td>
								<td>{{ $item->email_verified_at }}</td>
								<td>{{ $item->is_enable }}</td>
								<td>{{ $item->is_super }}</td>
								<td>{{ $item->last_login_at }}</td>
                                <td>
                                    <a href="{{ route('users.show', $item->getKey()) }}" class="btn btn-primary btn-sm" title="显示">
                                        <i class="fas fa-folder"></i> 显示
                                    </a>
                                    <a href="{{ route('users.edit', $item->getKey()) }}" class="btn btn-info btn-sm" title="编辑">
                                        <i class="fas fa-pencil-alt"></i> 编辑
                                    </a>
                                    <a href="{{ route('users.destroy', $item->getKey()) }}" class="btn btn-danger btn-sm delete" title="删除">
                                        <i class="fas fa-trash"></i> 删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>{{ __('user.id') }}</th>
							<th>{{ __('user.username') }}</th>
							<th>{{ __('user.password') }}</th>
							<th>{{ __('user.name') }}</th>
							<th>{{ __('user.email') }}</th>
							<th>{{ __('user.email_verified_at') }}</th>
							<th>{{ __('user.is_enable') }}</th>
							<th>{{ __('user.is_super') }}</th>
							<th>{{ __('user.last_login_at') }}</th>
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
	$('#users-table').DataTable({
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

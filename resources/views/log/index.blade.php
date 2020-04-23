@extends('layouts.app')

@section('title', __('log.module') . '列表')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('log.module') }}列表</h3>
            </div>

            <div class="card-body">
                <table id="logs-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('log.id') }}</th>
                            <th>{{ __('log.created_at') }}</th>
							<th>{{ __('log.user_id') }}</th>
							<th>{{ __('log.ip') }}</th>
							<th>{{ __('log.code') }}</th>
							<th>{{ __('log.path') }}</th>
							<th>{{ __('log.action') }}</th>
							<th>{{ __('log.model') }}</th>
							<th>{{ __('log.model_id') }}</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
								<td>{{ $item->user->username }}</td>
								<td>{{ $item->ip }}</td>
								<td>{{ $item->code }}</td>
								<td>{{ $item->path }}</td>
								<td>{{ $item->action }}</td>
								<td>{{ $item->model }}</td>
								<td>{{ $item->model_id }}</td>
                                <td>
                                    <a href="{{ route('logs.show', $item) }}" class="btn btn-primary btn-sm" title="显示">
                                        <i class="fas fa-folder"></i> 显示
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>{{ __('log.id') }}</th>
                            <th>{{ __('log.created_at') }}</th>
							<th>{{ __('log.user_id') }}</th>
							<th>{{ __('log.ip') }}</th>
							<th>{{ __('log.code') }}</th>
							<th>{{ __('log.path') }}</th>
							<th>{{ __('log.action') }}</th>
							<th>{{ __('log.model') }}</th>
							<th>{{ __('log.model_id') }}</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
	$('#logs-table').DataTable({
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

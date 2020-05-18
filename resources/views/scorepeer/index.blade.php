@extends('layouts.app')

@section('title', __('scorepeer.module') . __('Assign Teacher'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('scorepeer.module') . __('Assign Teacher') }}</h3>
            </div>

            <div class="card-body">
                <table id="scorepeers-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->present()->allTeachers }}</td>
                                <td>
                                    @can('create', $item)
                                        <a href="{{ route('scorepeers.create', $item) }}" class="btn btn-success btn-sm" title="{{ __('Assign Teacher') }}">
                                            <i class="fas fa-user-friends"></i> {{ __('Assign Teacher') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
	$('#scorepeers-table').DataTable({
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

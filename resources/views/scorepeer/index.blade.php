@extends('layouts.app')

@section('title', __('scorepeer.module') . __('List'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('scorepeer.module') . __('List') }}</h3>
            </div>

            <div class="card-body">
                <table id="scorepeers-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
								<td>{{ $item->year }}</td>
								<td>{{ optional($item->user)->name }}</td>
								<td>{{ optional($item->judge)->name }}</td>
								<td>{{ $item->number }}</td>
								<td>{{ $item->score }}</td>
								<td>{{ $item->is_confirmed }}</td>
								<td>{{ $item->course }}</td>
								<td>{{ $item->time }}</td>
								<td>{{ $item->classroom }}</td>
								<td>{{ $item->class }}</td>
								<td>{{ $item->file }}</td>
                                <td>
                                    @can('update', $item)
                                        <a href="{{ route('scorepeers.edit', $item) }}" class="btn btn-info btn-sm" title="{{ __('Score') }}">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Score') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('scorepeer.id') }}</th>
							<th>{{ __('scorepeer.year') }}</th>
							<th>{{ __('scorepeer.judge_id') }}</th>
							<th>{{ __('scorepeer.user_id') }}</th>
							<th>{{ __('scorepeer.number') }}</th>
							<th>{{ __('scorepeer.course') }}</th>
							<th>{{ __('scorepeer.time') }}</th>
							<th>{{ __('scorepeer.classroom') }}</th>
							<th>{{ __('scorepeer.class') }}</th>
							<th>{{ __('scorepeer.score') }}</th>
							<th>{{ __('scorepeer.file') }}</th>
							<th>{{ __('scorepeer.is_confirmed') }}</th>
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

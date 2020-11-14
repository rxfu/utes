@extends('layouts.app')

@section('title', '分组抽签')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">分组抽签</h3>
            </div>

            <div class="card-body">
                <table id="users-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('user.seq') }}</th>
                            <th>{{ __('user.group') }}</th>
                            <th>{{ __('user.name') }}</th>
                            <th>{{ __('user.department_id') }}</th>
                            <th>{{ __('user.gender_id') }}</th>
                            <th>{{ __('user.phone') }}</th>
                            <th>{{ __('application.applied_title_id') }}</th>
                            <th>{{ __('application.course') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            @foreach ($item->groups as $group)
                                <tr>
                                    <td>{{ $group->pivot->is_drawed ? $group->pivot->seq : '' }}</td>
                                    <td>{{ $group->pivot->is_drawed ? $group->name : '' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ optional($item->department)->name }}</td>
                                    <td>{{ optional($item->gender)->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ optional($item->application->appliedTitle)->name }}</td>
                                    <td>{{ optional($item->application)->course }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ __('user.seq') }}</th>
                            <th>{{ __('user.group') }}</th>
                            <th>{{ __('user.name') }}</th>
                            <th>{{ __('user.department_id') }}</th>
                            <th>{{ __('user.gender_id') }}</th>
                            <th>{{ __('user.phone') }}</th>
                            <th>{{ __('application.applied_title_id') }}</th>
                            <th>{{ __('application.course') }}</th>
                        </tr>
                    </tfoot>
                </table>
                @if (!Auth::user()->is_super)
                    @foreach ($items[0]->groups as $group)
                        @if ($group->pivot->is_drawed)
                            <h1 class="text-center text-success" style="font-size: 4em">
                                <strong>您抽到的号是</strong>
                            </h1>
                            <h1 class="text-center text-danger" style="font-size: 8em">
                                {{ $group->name }}第{{ $group->pivot->seq }}号
                            </h1>
                        @else
                            <form role="form" id="draw-form" name="draw-form" method="post" action="{{ route('users.draw') }}">
                                @csrf
                                @method('put')
                                <div class="row justify-content-sm-center">
                                    <button type="submit" class="btn btn-primary">
                                        开始抽签
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endforeach
                @endif
            </div>
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

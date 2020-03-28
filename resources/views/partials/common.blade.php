<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{ $modname ?? '' }}列表</h3>
	</div>

    <form id="delete-form" action="{{ route($model . '.delete') }}" method="post">
    	@csrf
        @method('delete')
    @section('list')
		<div class="card-body">
			<table id="itemsTable" class="table table-bordered table-striped datatable">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col" class="all">
                            <div class="form-check">
                                <input type="checkbox" id="allItems" name="allItems" value="all">
                            </div>
                        </th>
						@foreach ($components as $component)
							@if (!empty($component['list']))
								<th scope="col" class="{{ isset($component['responsive']) ? $component['responsive'] : 'desktop' }}">{{ __($model . '.' . $component['field']) }}</th>
							@endif
						@endforeach
						<th scope="col" class="all">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<td></td>
							<td>
                                <div class="form-check">
                                    <input type="checkbox" name="items[]" value="{{ $item->id }}">
                                </div>
                            </td>
							@foreach ($components as $component)
								@if (!empty($component['list']))
									<td>
										@if (!empty($component['presenter']))
											{{ $item->present()->{Illuminate\Support\Str::camel($component['field'])} }}
										@elseif (!empty($component['relation']))
											@if (!is_null($item->{$component['relation']}))
												{{ $item->{$component['relation']}->implode('name', ', ') }}
											@endif
										@else
											{{ $item->{$component['field']} }}
										@endif
									</td>
								@endif
							@endforeach
	                        <td>
	                            <a href="{{ route($model . '.index', ['edit', $item->id]) }}" class="btn btn-info btn-flat btn-sm" title="编辑">
	                                <i class="icon fa fa-edit"></i> 编辑
	                            </a>

	                            @if (config('components.' . $model . '.reset'))
							    	<a href="{{ route('password.reset', $item->id) }}" class="btn btn-warning btn-flat btn-sm" title="重置密码">
								        <i class="icon fa fa-key"></i> 重置密码
								    </a>
								@endif
	                        </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@show
		
		<div class="card-footer">
			<div class="row">
				<div class="col">
			        <button type="submit" class="btn btn-danger" onclick="return window.confirm('请问确定要删除这些{{ $modname }}吗？')">
			            <i class="icon fa fa-trash"></i> 删除所选
			        </button>
			    </div>
			    <div class="col text-right">
			    	<a href="{{ route($model . '.index', 'create') }}" class="btn btn-success">
			    		<i class="icon fa fa-plus"></i> 创建{{ $modname ?: '' }}
			    	</a>
			    </div>
			</div>
		</div>
	</form>
</div>

@push('styles')
<!-- Datatables -->
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- Datatable -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('vendor/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
$(function() {
	$('.datatable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('vendor/datatables/lang/Chinese.json') }}"
        },
        'responsive': {
            'details': {
                'type': "column",
                'target': 0
            }
        },
        'columnDefs': [{
        	'orderable': false,
        	'targets': 1
        }, {
            'className': 'control',
            'orderable': false,
            'targets': 0
        }],
        "order": []
    });

    $('#allItems').change(function () {
        $(':checkbox[name="items[]"]').prop('checked', $(this).is(':checked') ? true : false);
    });

    $('.datetimepicker').datetimepicker({
    	locale: 'zh-cn',
    	icons: {
    		time: 'far fa-clock',
    		date: 'far fa-calendar-alt',
    		up: 'fas fa-arrow-up',
    		down: 'fas fa-arrow-down'
    	}
	});
})
</script>
@endpush

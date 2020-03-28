<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{ $modname ?? '' }}列表</h3>
	</div>

	<div class="card-body">
		<table id="itemsTable" class="table table-bordered table-striped datatable">
			<thead>
				<tr>
					<th scope="col"></th>
					@foreach ($components as $component)
						@if (!empty($component['list']))
							<th scope="col" class="{{ isset($component['responsive']) ? $component['responsive'] : 'desktop' }}">{{ __($model . '.' . $component['field']) }}</th>
						@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $item)
					<tr>
						<td></td>
						@foreach ($components as $component)
							@if (!empty($component['list']))
								<td>
									@if (!empty($component['presenter']))
										{{ $item->present()->{Illuminate\Support\Str::camel($component['field'])} }}
									@else
										{{ $item->{$component['field']} }}
									@endif
								</td>
							@endif
						@endforeach
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@push('styles')
<!-- Datatables -->
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- Datatable -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.bootstrap4.min.js') }}"></script>
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
})
</script>
@endpush

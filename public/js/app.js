$(function(){
	$('.nav-sidebar li:not(.has-treeview) > a').on('click', function() {
		$(this).addClass('active');
		// $(this).siblings('.treeview.active').find('> a').trigger('click');
		$(this).siblings().removeClass('active').find('li').removeClass('active');
		/* 
		var $parent = $(this).parent().addClass('active');
		$parent.siblings('.treeview.active').find('> a').trigger('click');
		$parent.siblings().removeClass('active').find('li').removeClass('active'); */
	});

	// $(window).on('load', function() {
		$('.nav-sidebar a').each(function() {
			if(this.href === window.location.href) {
				$(this).addClass('active')
				.closest('.has-treeview').addClass('.menu-open')
				.closest('.nav-link').addClass('active');
				/* 
				$(this).parent().addClass('active')
						.closest('.treeview-menu').addClass('.menu-open')
						.closest('.treeview').addClass('active'); */
			}
		});
	// });

	$('.datatable').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "/laradmin/plugins/datatables/lang/Chinese.json",
            'buttons': {
                'excel': '导出Excel',
                'pdf': '导出PDF',
                'print': '打印',
                'colvis': '隐藏列'
            }
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
        'order': [],
        'dom': 'Bfrtip',
        'buttons': ['excel', 'pdf', 'print', 'colvis'],
	});
	
	$('.datepicker').daterangepicker();
});
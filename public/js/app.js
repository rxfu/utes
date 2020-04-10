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
				$(this).addClass('active').closest('.has-treeview').addClass('menu-open');
				$(this).closest('.has-treeview').closest('.nav-link').addClass('active');
				/* 
				$(this).parent().addClass('active')
						.closest('.treeview-menu').addClass('.menu-open')
						.closest('.treeview').addClass('active'); */
			}
		});
	// });

	$('.datepicker').daterangepicker();
});
$(function () {
    $('.nav-sidebar li:not(.has-treeview) > a').on('click', function () {
        $(this).addClass('active');
        // $(this).siblings('.treeview.active').find('> a').trigger('click');
        $(this).siblings().removeClass('active').find('li').removeClass('active');
        /* 
        var $parent = $(this).parent().addClass('active');
        $parent.siblings('.treeview.active').find('> a').trigger('click');
        $parent.siblings().removeClass('active').find('li').removeClass('active'); */
    });

    // $(window).on('load', function() {
    $('.nav-sidebar a').each(function () {
        if (window.location.href.indexOf(this.href) == 0) {
            $(this).addClass('active').closest('.has-treeview').addClass('menu-open')
                .children('a.nav-link').addClass('active');
            /* 
            $(this).parent().addClass('active')
            		.closest('.treeview-menu').addClass('.menu-open')
            		.closest('.treeview').addClass('active'); */
        }
    });
    // });

    $('.delete').click(function () {
        event.preventDefault();

        if (confirm('记录删除后不可恢复，请问确定删除该条记录吗？')) {
            var href = $(this).attr('href');
            $('#delete-form').attr('action', href).submit();

            return false;
        }
    })

    $('.datepicker').daterangepicker();

    $('.select2').select2({
        theme: 'bootstrap4'
    });
});

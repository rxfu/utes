<!-- Main footer -->
<footer class="main-footer">
    <div class="float-right d-done d-sm-inline-block">
    	{{ date('Y年m月d日') }}
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}" title="{{ config('setting.copyright') }}">{{ config('setting.copyright') }}</a>.</strong> 版权所有.
</footer>
<!-- ./main-footer -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="{{ config('setting.keywords') }}">
    <meta name="description" content="{{ config('setting.description') }}">
    <meta name="author" content="{{ config('setting.author') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '默认页面') | {{ config('setting.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}" defer></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte/js/adminlte.min.js') }}" defer></script>
    <!-- App Script -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <!-- Font Awesome Icons -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- iCheck Bootstrap -->
    <link href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('admin-lte/css/adminlte.min.css') }}" rel="stylesheet">
    <!-- App style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    @stack('styles')
</head>
<body class="hold-transition @yield('body-class')">

    <!-- Site wrapper -->
    <div class="wrapper">
        @yield('page')
    </div>
    <!-- ./wrapper -->

    <!-- Custom scripts -->
    @stack('scripts')
</body>
</html>

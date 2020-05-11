@extends('layouts.default')

@section('body-class', 'lockscreen')

@section('page')
    <!-- Main content -->
    <main class="lockscreen-wrapper">
        @yield('content')
    </main>
    <!-- ./content -->
@endsection

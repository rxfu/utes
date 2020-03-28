@extends('layouts.default')

@section('title', $title)

@section('body-class', 'layout-top-nav')

@section('page')
    @include('shared.header')

    <!-- Content wrapper -->
    <div class="content-wrapper">
	    <!-- Main content -->
	    <main class="content">
            <div class="login-page">
                <!-- Login box -->
                <div class="login-box">
                    @include('shared.alert')

                    <!-- Login card -->
                    <div class="card">
                        <div class="card-body login-card-body">
                            <p class="login-box-msg">{{ $title }}</p>
                            
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
	    </main>
    </div>

    @include('shared.footer')

    @include('shared.control')
@endsection
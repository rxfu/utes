@extends('layouts.default')

@section('body-class', 'layout-top-nav')

@section('page')
    @include('shared.header')

    <!-- Content wrapper. Contains page content -->
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
                            <p class="login-box-msg">@yield('title', '默认页面')</p>
                            
                            @yield('content')
                        </div>
                        <!-- ./login-card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- ./login-box -->
            </div>
            <!-- ./login-page -->
        </main>
        <!-- ./content -->
    </div>

    @include('shared.control')
    @include('shared.footer')
@endsection

@push('styles')
<style>
.login-logo {
    font-size: 28px;
}
.login-page {
    height: calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px)) !important;
}
</style>
@endpush

@extends('layouts.default')

@section('body-class', 'layout-top-nav')

@section('page')
    @include('shared.header')

    <!-- Content wrapper. Contains page content -->
    <div class="content-wrapper">
	    <!-- Main content -->
	    <main class="content">
            <div class="container single-page">
                    @include('shared.alert')

                    <!-- Login card -->
                    <div class="card my-6">
                        <div class="card-header text-center">
                            @yield('title', '默认页面')
                        </div>
                        <div class="card-body">                            
                            @yield('content')
                        </div>
                        <!-- ./login-card-body -->
                    </div>
                    <!-- ./card -->
            </div>
            <!-- ./container -->
        </main>
        <!-- ./content -->
    </div>

    @include('shared.control')
    @include('shared.footer')
@endsection

@push('styles')
<style>
.single-page {
    /* min-height: calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px)) !important; */
}
</style>
@endpush

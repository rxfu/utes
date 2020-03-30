@extends('layouts.default')

@section('body-class', 'sidebar-mini')

@section('page')
    @include('shared.header')
    @include('shared.sidebar')

    <!-- Content wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('shared.alert')
        
    	<!-- Content header (Page header) -->
    	<section class="content-header">
    		<div class="container-fluid">
    			<div class="row mb-2">
    				<div class="col-sm-6">
    					<h1 class="m-0 text-dark">@yield('title', '默认页面')</h1>
    				</div>
    				<div class="col-sm-6">
    					{{-- @include('shared.breadcrumb') --}}
    				</div>
    			</div>
			</div>
			<!-- ./container-fluid -->
		</section>
		<!-- ./content-header -->

	    <!-- Main content -->
	    <main class="content">
	    	<div class="container-fluid">
	    		@yield('content')
			</div>
			<!-- ./container-fluid -->
		</main>
		<!-- ./content -->
	</div>
	<!-- ./content-wrapper -->

    @include('shared.control')
    @include('shared.footer')
@endsection

@extends('layouts.default')

@section('title', $title)

@section('body-class', 'sidebar-mini')

@section('page')
    @include('shared.header')

    @include('shared.sidebar')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        @include('shared.alert')
        
    	<!-- Content header -->
    	<section class="content-header">
    		<div class="container-fluid">
    			<div class="row mb-2">
    				<div class="col-sm-6">
    					<h1 class="m-0 text-dark">{{ $title ?? 'Default'}}</h1>
    				</div>
    				<div class="col-sm-6">
    					{{-- @include('shared.breadcrumb') --}}
    				</div>
    			</div>
    		</div>
    	</section>

	    <!-- Main content -->
	    <main class="content">
	    	<div class="content-fluid">
	    		@yield('content')
	    	</div>
	    </main>
    </div>

    @include('shared.footer')

    @include('shared.control')
@endsection
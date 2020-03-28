@extends('layouts.app')

@section('content')
<div class="row">
	@if (config('components.' . $model . '.list'))
	    <div class="col-sm-12">
	        @include('partials.list', ['components' => config('components.' . $model)])
	    </div>
	@else
	    <div class="col-sm-8">
	        @include('partials.common', ['components' => config('components.' . $model)])
	    </div>

	    <div class="col-sm-4">
	        @includeIf('partials.' . $action, ['components' => config('components.' . $model)])
	    </div>
	@endif
</div>
@stop

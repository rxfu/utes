@extends('layouts.page')

@section('title', '服务器错误')

@section('content')
<div class="error-page">
    <h2 class="headline text-danger">500</h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

        <p>
        We will work on fixing that right away.
        Meanwhile, you may <a href="{{ route('home') }}">return to dashboard</a> or try using the search form.
        </p>
    </div>
</div>
<!-- /.error-page -->
@endsection

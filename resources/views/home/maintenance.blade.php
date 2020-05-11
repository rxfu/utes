@extends('layouts.screen')

@section('title', '系统关闭')

@section('content')
<div class="error-page">
    <h2 class="headline text-warning"> 
        <i class="fas fa-times fa-lg"></i>
    </h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> 系统已关闭</h3>

        <p>
            请 <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">点击此处</a> 退出系统！

            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                @csrf
            </form>
        </p>
    </div>
    <!-- /.error-content -->
</div>
<!-- /.error-page -->
@endsection

@push('styles')
    <style>
        .error-page > .error-content {
            margin-left: 150px;
        }
    </style>
@endpush

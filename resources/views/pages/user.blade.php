@extends('pages.index')

@section('operator')
    <a href="{{ route($model . '.reset', $item->id) }}" class="btn btn-warning btn-flat btn-sm" title="重置密码">
        <i class="icon fa fa-key"></i> 重置密码
    </a>
@stop
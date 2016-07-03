{{-- Part of phoenix project. --}}

@extends('_global.admin.html')

@section('body')
    @include('_global.admin.header')

<div class="container-fluid">
    <div class="row">
        <div class="main-sidebar col-md-2">
            @include('_global.admin.widget.submenu')
        </div>
        <div class="main-body col-md-10">
            @yield('content', 'Content Section')

            @include('_global.admin.copyright')
        </div>
    </div>
</div>
@stop

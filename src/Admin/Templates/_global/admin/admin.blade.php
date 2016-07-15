{{-- Part of Admin project. --}}

@extends('_global.admin.admin-wrapper')

@section('content')
    @section('banner')
        @include('_global.admin.widget.banner')
    @show

    @section('toolbar')
        @include('_global.admin.widget.toolbar')
    @show

    @section('admin-area')
    <section id="admin-area">
        @messages

        @yield('admin-body', 'Admin Body')
    </section>
    @show
@stop

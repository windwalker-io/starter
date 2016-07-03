{{-- Part of Admin project. --}}

@extends('_global.admin.admin-wrapper')

@section('content')
    @include('_global.admin.widget.banner')

    @include('_global.admin.widget.toolbar')

    @section('admin-area')
    <section id="admin-area">
        @messages

        @yield('admin-body', 'Admin Body')
    </section>
    @show
@stop

{{-- Part of phoenix project. --}}

@extends('_global.admin.html')

@section('body')
    @section('header')
        @include('_global.admin.header')
    @show

    <div class="container-fluid">
        <div class="row">
            <div class="main-sidebar col-md-2">
                @include('_global.admin.widget.submenu')
            </div>
            <div class="main-body col-md-10">
                @yield('content', 'Content Section')

                @section('copyright')
                    @include('_global.admin.copyright')
                @show
            </div>
        </div>
    </div>
@stop

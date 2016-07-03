{{-- Part of Admin project. --}}

@extends('_global.admin.html')

@section('superbody')
    {{-- Force Background white i template has colored bg --}}
    <div style="background: white;">
        @yield('body', 'Body')
    </div>
@stop

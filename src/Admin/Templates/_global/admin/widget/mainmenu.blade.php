
@section('nav')
    <li class="{{ $helper->menu->active('home') }}">
        <a href="{{ $router->route('home') }}">
            @translate('phoenix.title.dashboard')
        </a>
    </li>
@stop

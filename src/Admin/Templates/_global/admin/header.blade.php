{{-- Part of phoenix project. --}}
<?php
/**
 * @var  $router  \Windwalker\Core\Router\PackageRouter
 */
?>

@section('header')
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ $router->route('articles') }}">LYRASOFT</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @section('nav')
                        @include('_global.admin.widget.mainmenu')
                    @show
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ $router->route('front@home') }}" target="_blank">
                            <span class="glyphicon glyphicon-globe fa fa-globe"></span>
                        </a>
                    </li>

                    @if (\Lyrasoft\Warder\Helper\UserHelper::isLogin())
                        <li>
                            <a href="{{ $router->route('logout') }}">
                                <span class="glyphicon glyphicon-log-out fa fa-sign-out"></span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
@show

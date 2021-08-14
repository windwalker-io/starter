<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $view      ViewModel       The view modal object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@section('header')
    <div class="navbar navbar-dark bg-dark navbar-fixed-top navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ $uri->path() }}">
                <img src="{{ $asset->path('images/logo-h.svg') }}"
                    alt="LOGO"
                    style="height: 25px;"
                />
            </a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target="#top-navbar-content" aria-controls="#top-navbar-content" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="top-navbar-content" class="collapse navbar-collapse">
                <ul class="nav navbar-nav me-auto">
                    @section('nav')
                        @include('admin.global.widget.mainmenu')
                    @show
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a href="{{ $nav->to('front@home')->mute() }}" target="_blank"
                            class="nav-link hasTooltip" title="Preview" data-placement="bottom">
                            <span class="far fa-eye"></span>
                        </a>
                    </li>

                    {{--                @if ($user->isMember())--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="{{ $router->to('logout')->mute() }}"--}}
                    {{--                           class="nav-link hasTooltip" title="Logout" data-placement="bottom">--}}
                    {{--                            <span class="glyphicon glyphicon-log-out fa fa-sign-out fa-sign-out-alt"></span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    {{--                @endif--}}
                </ul>
            </div>
        </div>
        <!--/.nav-collapse -->
    </div>

@show

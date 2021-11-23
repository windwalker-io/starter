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

@extends('global.html')

@section('superbody')
    <div class="container" style="margin-top: 100px">
        <div class="mx-auto w-100" style="max-width: 450px">
            <div class="mb-4 p-4">
                <a href="{{ $nav->to('front::home') }}" target="_blank">
                    <img class="img-fluid" src="https://i.imgur.com/tjr9ixV.png" alt="LOGO">
                </a>
            </div>

            @section('message')
                @include('@messages')
            @show

            @yield('container', 'Container')
        </div>
    </div>
@stop

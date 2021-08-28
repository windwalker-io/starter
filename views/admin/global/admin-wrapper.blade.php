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
@section('header')
    @include('admin.global.header')
@show

@section('container')
<div class="container-fluid" style="">
    <div class="row">
        <div class="main-sidebar col-md-2">
            @include('admin.global.widget.submenu')
        </div>
        <div class="main-body col-md-10">
            @yield('body', 'Body Section')

            @section('copyright')
                @include('admin.global.copyright')
            @show
        </div>
    </div>
</div>
@show
@stop

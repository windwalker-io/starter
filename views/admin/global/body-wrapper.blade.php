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

$htmlFrame = $app->service(\Windwalker\Core\Html\HtmlFrame::class);
?>

@extends('global.html')

@section('superbody')
<div class="main-wrapper" uni-cloak>
    {{-- Header --}}
    @section('header')
        @include('admin.global.layout.header')
    @show

    {{-- Main Container --}}
    @section('container')
    {{-- Sidebar --}}
    <div class="row flex-lg-nowrap">
        @section('sidebar')
            <div class="main-sidebar col-lg-2">
                @include('admin.global.layout.submenu')
            </div>
        @show
        <div class="main-body col">
            @yield('body', 'Body Section')

            @section('footer')
                @include('admin.global.layout.footer')
            @show
        </div>
    </div>
    @show
</div>
@stop

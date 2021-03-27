<?php

declare(strict_types=1);

namespace App\View;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Global Application
 * @var $view      ViewModel       Some information of this view.
 * @var $uri       SystemUri       Uri information, example: $uri->path
 * @var $chronos   ChronosService  PHP DateTime object of current time.
 * @var $nav       Navigator       Router object.
 * @var $asset     AssetService    The Asset manager.
 * @var $lang      LangService     The language manager.
 */

?><!DOCTYPE html>
<html lang="{{ $lang->getLocale() ? : $lang->getFallback() }}">
<head>
    <base href="{{ $uri::normalize($uri->path .  '/') }}" />

    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

    <title>{{ \Phoenix\Html\HtmlHeader::getPageTitle() }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ $asset->path('images/favicon.ico') }}"/>
    <meta name="generator" content="Windwalker Framework"/>
    {!! \Phoenix\Html\HtmlHeader::renderMetadata() !!}
    @yield('meta')

    {!! $asset->renderStyles(true) !!}
    @yield('style')
    @stack('style')
    {!! \Phoenix\Html\HtmlHeader::renderCustomTags() !!}
</head>
<body class="{{ $package->getName() }}-admin-body phoenix-admin
@yield('body-class', $bodyClass ?? '') {{ $hideSidebar ? 'sidebar-hide' : null }}
    bootstrap-{{ \Phoenix\Script\BootstrapScript::$currentVersion }}">
@section('superbody')

    @yield('body', 'Body Section')

@show
{!! $asset->getTemplate()->renderTemplates() !!}
{!! $asset->renderScripts(true) !!}
@yield('script')
@stack('script')
</body>
</html>

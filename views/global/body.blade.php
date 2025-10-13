<?php

declare(strict_types=1);

namespace App\View;

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

use Lyrasoft\Luna\Repository\CategoryRepository;
use Lyrasoft\Luna\Services\ConfigService;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$coreConfig = $app->service(ConfigService::class)->getConfig('core');

$categories = $app->service(CategoryRepository::class)
    ->getAvailableListSelector()
    ->where('category.state', 1)
    ->where('category.type', 'article')
    ->ordering('category.lft', 'ASC');

?>

@extends('global.html')

@if ($ga = trim((string) $coreConfig->get('ga')))
@push('meta')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $ga }}');
    </script>
@endpush
@endif

@if ($gtm = trim((string) $coreConfig->get('gtm')))
@push('meta')
    <!-- Google Tag Manager -->
    <script>
      (function(w,d,s,l,i){w[l]=w[l] = w[l] || []; w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'}); var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:''; j.async=true;
      j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl; f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','{{ $gtm }}');
    </script>
    <!-- End Google Tag Manager -->
@endpush
@endif

@section('superbody')
    @if ($gtm = trim((string) $coreConfig->get('gtm')))
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtm }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    @section('header')
        @include('global.header')
    @show

    @section('body')
        @section('message')
            @include('@messages')
        @show

        @yield('content', 'Content')
    @show

    @section('footer')
        @include('global.footer')
    @show
@stop

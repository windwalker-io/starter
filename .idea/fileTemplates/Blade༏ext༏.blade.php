<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var ${DS}app       AppContext      Application context.
 * @var ${DS}vm        object          The view model object.
 * @var ${DS}uri       SystemUri       System Uri information.
 * @var ${DS}chronos   ChronosService  The chronos datetime service.
 * @var ${DS}nav       Navigator       Navigator object to build route.
 * @var ${DS}asset     AssetService    The Asset manage service.
 * @var ${DS}lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@extends('global.body')

@section('content')

@stop

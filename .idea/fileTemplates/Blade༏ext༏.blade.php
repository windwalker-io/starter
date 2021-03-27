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
 * @var ${DS}app       AppContext                 Global Application
 * @var ${DS}view      ViewModel                       Some information of this view.
 * @var ${DS}uri       SystemUri                     Uri information, example: ${DS}uri->path
 * @var ${DS}chronos   ChronosService   PHP DateTime object of current time.
 * @var ${DS}nav       Navigator       Router object.
 * @var ${DS}asset     AssetService         The Asset manager.
 * @var ${DS}lang      LangService         The language.
 */

?>

@extends('global.html')

@section('content')

@stop

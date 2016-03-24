{{-- Part of Front project. --}}
<?php
/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app      \Windwalker\Web\Application                 Global Application
 * @var $package  \Front\FrontPackage                   Package object.
 * @var $view     \Windwalker\Data\Data                       Some information of this view.
 * @var $uri      \Windwalker\Registry\Registry               Uri information, example: $uri['media.path']
 * @var $datetime \DateTime                                   PHP DateTime object of current time.
 * @var $helper   \Windwalker\Core\View\Helper\Set\HelperSet  The Windwalker HelperSet object.
 * @var $router   \Windwalker\Core\Router\PackageRouter       Router object.
 *
 * View variables
 * --------------------------------------------------------------
 * @var $item  \Windwalker\Data\Data
 * @var $state \Windwalker\Registry\Registry
 */
?>

@extends('_global.html')

@section('content')
<div class="container sakura-item">
    <h1>Sakura Item</h1>
    <p>
        <a class="btn btn-default" href="{{ $router->html('sakuras') }}">
            <span class="glyphicon glyphicon-chevron-left fa fa-chervon-left"></span>
            Back to List
        </a>
    </p>
    <hr />
    <h2>{{ $item->title }}</h2>
    <p>{{ $item->introtext }}</p>
    <p>{{ $item->fulltext }}</p>
</div>
@stop

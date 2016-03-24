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
 * @var $state         \Windwalker\Registry\Registry
 * @var $items         \Windwalker\Data\DataSet
 * @var $item          \Windwalker\Data\Data
 * @var $pagination    \Windwalker\Core\Pagination\Pagination
 */
?>

@extends('_global.html')

@section('content')
<div class="container sakura-item">
    <h1>Sakura List</h1>
    <p>Hello World.</p>
    <div class="sakuras-items">
        @foreach ($items as $i => $item)
        <div class="sakura-item">
            <p>
                <span class="glyphicon glyphicon-menu-right fa fa-angle-right text-muted"></span>
                <a href="{{ $router->html('sakura', array('id' => $item->id)) }}">
                    {{ $item->title }}
                </a>
            </p>
        </div>
        @endforeach
    </div>
    <hr />
    <div class="pagination">
        {!! $pagination->render('front@sakuras') !!}
    </div>
</div>
@stop

<?php

declare(strict_types=1);

namespace App\Routes;

use App\Module\Foo\Hello\HelloController;
use App\Module\Foo\Hello\HelloEditView;
use App\Module\Foo\Hello\HelloListView;
use Windwalker\Core\Router\RouteCreator;

/** @var  RouteCreator $router */

$router->group('hello')
    ->extra('menu', ['sidemenu' => 'hello_list'])
    ->register(function (RouteCreator $router) {
        $router->any('hello_list', '/hello/list')
            ->controller(HelloController::class)
            ->view(HelloListView::class)
            ->postHandler('copy')
            ->putHandler('filter')
            ->patchHandler('batch');

        $router->any('hello_edit', '/hello/edit[/{id}]')
            ->controller(HelloController::class)
            ->view(HelloEditView::class);
    });

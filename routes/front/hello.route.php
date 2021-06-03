<?php

// namespace App\Routes;

use App\Module\Admin\Sakura\SakuraController;
use App\Module\Admin\Sakura\SakuraEditView;
use App\Module\Admin\Sakura\SakuraListView;
use App\Module\Front\Hello\HelloController;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('hello')
    ->register(function (RouteCreator $router) {
        $router->any('hello_list', '/hello-list')
            ->controller(HelloController::class)
            ->postHandler('copy')
            ->patchHandler('batch')
            ->putHandler('filter')
            ->deleteHandler('delete');

        $router->any('hello_edit', '/hello/edit[/{id}]')
            ->controller(SakuraController::class)
            ->view(SakuraEditView::class);
    });

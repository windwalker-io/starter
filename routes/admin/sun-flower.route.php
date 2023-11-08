<?php

declare(strict_types=1);

namespace App\Routes;

use App\Module\Admin\SunFlower\SunFlowerController;
use App\Module\Admin\SunFlower\SunFlowerEditView;
use App\Module\Admin\SunFlower\SunFlowerListView;
use Windwalker\Core\Router\RouteCreator;

/** @var  RouteCreator $router */

$router->group('sun-flower')
    ->extra('menu', ['sidemenu' => 'sun_flower_list'])
    ->register(function (RouteCreator $router) {
        $router->any('sun_flower_list', '/sun-flower/list')
            ->controller(SunFlowerController::class)
            ->view(SunFlowerListView::class)
            ->postHandler('copy')
            ->putHandler('filter')
            ->patchHandler('batch');

        $router->any('sun_flower_edit', '/sun-flower/edit[/{id}]')
            ->controller(SunFlowerController::class)
            ->view(SunFlowerEditView::class);
    });

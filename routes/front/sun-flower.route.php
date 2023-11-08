<?php

declare(strict_types=1);

namespace App\Routes;

use App\Module\Front\SunFlower\SunFlowerListView;
use App\Module\Front\SunFlower\SunFlowerController;
use App\Module\Front\SunFlower\SunFlowerItemView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('sun-flower')
    ->register(function (RouteCreator $router) {
        $router->get('sun_flower_list', '/sun-flower/list')
            ->controller(SunFlowerController::class)
            ->view(SunFlowerListView::class);

        $router->get('sun_flower_item', '/sun-flower/item/{id}')
            ->controller(SunFlowerController::class)
            ->view(SunFlowerItemView::class);
    });

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use App\Controller\TestController;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('front')
    ->register(function (RouteCreator $router) {
        $router->get('home', '/')
            ->handler([TestController::class, 'hello']);

        $router->group('hello')
            ->prefix('/hello')
            ->register(function (RouteCreator $router) {
                $router->any('hello', '/{id:\d+}[/{name}]')
                    ->handlers(
                        ['post'],
                        TestController::class,
                        'hello'
                    );
            });
    });

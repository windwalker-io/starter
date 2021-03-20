<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use App\Component\Front\Home\HomeController;
use App\Front\Sakura\Sakura;
use App\Front\Test\TestController;
use App\Component\Front\Home\HomeView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('front')
    ->register(function (RouteCreator $router) {
        $router->get('home', '/')
            ->handler(HomeController::class)
            ->view(HomeView::class);

        // $router->get('sakura', '/sakura')
        //     ->handler(Sakura::class, 'index')
        //     ->var('view', \App\Front\Test\HelloView::class);
        //
        // $router->any('sakura_edit', '/sakura/edit[/{id:\d+}]')
        //     ->getHandler(Sakura::class, 'index')
        //     ->saveHandler(Sakura::class, 'save')
        //     ->var('view', \App\Front\Test\SakuraEditView::class);
        //
        // $router->group('hello')
        //     ->prefix('/hello')
        //     ->register(function (RouteCreator $router) {
        //         $router->any('hello', '/{id:\d+}[/{name}]')
        //             ->handlers(
        //                 ['get', 'post'],
        //                 TestController::class,
        //                 'hello'
        //             );
        //
        //         $router->any('test', '/test')
        //             ->handler(TestController::class);
        //     });
    });

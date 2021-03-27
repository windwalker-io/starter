<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);


namespace App\Routes;

use App\Module\Front\FrontMiddleware;
use App\Module\Front\Home\HomeController;
use App\Module\Front\Home\HomeView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('front')
    ->middleware(FrontMiddleware::class)
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

        $router->load(__DIR__ . '/front/*.php');

        $router->load(__DIR__ . '/packages/*.front.php');
    });

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use App\Module\Admin\AdminMiddleware;
use Lyrasoft\Luna\LunaPackage;
use Lyrasoft\Luna\Middleware\LoginRequireMiddleware;
use Windwalker\Core\Router\RouteCreator;

use function Windwalker\DI\create;

/** @var RouteCreator $router */

$router->group('admin')
    ->prefix('/admin')
    ->namespace('admin')
    ->middleware(
        LoginRequireMiddleware::class,
        excludes: [
            'admin::login',
            'admin::logout'
        ]
    )
    ->middleware(AdminMiddleware::class)
    ->register(function (RouteCreator $router) {
        //

        $router->load(__DIR__ . '/admin/*.php');

        $router->load(__DIR__ . '/packages/admin/*.route.php');

        $router->load(LunaPackage::path('routes/admin/*.route.php'));
    });

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use App\Module\Front\Home\HomeController;
use App\Module\Front\Home\HomeView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('web')
    ->register(function (RouteCreator $router) {
        $router->load(__DIR__ . '/front.php');
        $router->load(__DIR__ . '/admin.php');
    });

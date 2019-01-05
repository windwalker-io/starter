<?php
/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */
$router->group('package')
    ->register(function (RouteCreator $router) {
        $router->any('home', '/')
            ->controller('Page');

        $router->any('page', '/page')
            ->controller('Page');

        $router->any('cover', '/cover')
            ->controller('Cover');
    });

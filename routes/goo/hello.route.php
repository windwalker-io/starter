<?php

namespace App\Routes;

use Windwalker\Core\Router\RouteCreator;

/** @var  RouteCreator $router */

$router->group('hello')
    ->register(function (RouteCreator $router) {
        $router->any('hello', '/hello');
            //->controller()
            //->view();
    });

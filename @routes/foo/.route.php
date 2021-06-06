<?php

namespace App\Routes;

use Windwalker\Core\Router\RouteCreator;

/** @var  RouteCreator $router */

$router->group('')
    ->register(function (RouteCreator $router) {
        $router->any('hello', '/hello');
            //->controller()
            //->view();
    });

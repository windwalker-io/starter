<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Router\Router;

use Windwalker\DI\Container;

use function Windwalker\DI\create;

return [
    'routes' => [
        __DIR__ . '/../../routes/web.php'
    ],

    'providers' => [

    ],

    'bindings' => [
        Router::class => create(Router::class)
            ->extend(
                fn(Router $router, Container $container) => $router->register($container->getParam('routing.routes'))
            )
    ],

    'extends' => [
        //
    ]
];

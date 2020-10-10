<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

/** @var \FastRoute\RouteCollector $router */

$router->get(
    '/',
    [\App\Controller\TestController::class, 'hello']
);
$router->get(
    '/hello/{id:\d+}[/{name}]',
    [\App\Controller\TestController::class, 'hello']
);

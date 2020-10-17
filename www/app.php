<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Application\MicroApplication;
use Windwalker\Core\Router\RouteCreator;

include __DIR__ . '/../vendor/autoload.php';

error_reporting(-1);

$app = new MicroApplication();
// $app->loadConfig(__DIR__ . '/../etc/app/main.php');

$app->routing(function (RouteCreator $router) {
    $router->get('hello', '/hello/{id:\d+}[/{name}]')
        ->handler(function ($id, $name, \Psr\Http\Message\ServerRequestInterface $request) {
            show($id, $name, $request);
        });
});

$app->execute();

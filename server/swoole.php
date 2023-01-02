<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

$http = new \Swoole\Http\Server('127.0.0.1');
$http1 = $http->listen('127.0.0.1', 9501, SWOOLE_TCP);
$http1->on(
    'request',
    function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
        $response->end("<h1>Hello Swoole1. #" . rand(1000, 9999) . "</h1>");
    }
);

$http2 = $http->listen('127.0.0.1', 9502, SWOOLE_TCP);
$http2->on(
    'request',
    function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
        $response->end("<h1>Hello Swoole2. #" . rand(1000, 9999) . "</h1>");
    }
);
$http->start();

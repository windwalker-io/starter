<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Application\WebApplication;
use Windwalker\DI\Container;
use Windwalker\Http\Server\HttpServer;
use Windwalker\Http\Server\PhpServer;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'server' => [
        'http' => ref('di.servers.http'),
    ],
    'app' => [
        'main' => ref('di.apps.main'),
    ],
    'di' => [
        'servers' => [
            'http' => create(
                HttpServer::class,
                ...[
                    PhpServer::class => create(PhpServer::class),
                ]
            ),
        ],
        'apps' => [
            'main' => create(
                static function (Container $container) {
                    $app = new WebApplication($container->createChild());
                    $app->loadConfig(__DIR__ . '/config.php');

                    return $app;
                }
            ),
        ],
    ],
];

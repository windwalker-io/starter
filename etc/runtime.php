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
                    $app->loadConfig(__DIR__ . '/app/main.php');

                    return $app;
                }
            ),
        ],
    ],
    '@root' => WINDWALKER_ROOT,
    '@bin' => WINDWALKER_BIN,
    '@cache' => WINDWALKER_CACHE,
    '@etc' => WINDWALKER_ETC,
    '@logs' => WINDWALKER_LOGS,
    '@resources' => WINDWALKER_RESOURCES,
    '@source' => WINDWALKER_SOURCE,
    '@temp' => WINDWALKER_TEMP,
    '@views' => WINDWALKER_VIEWS,
    '@vendor' => WINDWALKER_VENDOR,
    '@public' => WINDWALKER_PUBLIC,
    '@migrations' => WINDWALKER_MIGRATIONS,
    '@seeders' => WINDWALKER_SEEDERS,
    '@languages' => WINDWALKER_LANGUAGES,
];

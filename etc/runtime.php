<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\DI\Container;
use Windwalker\Http\Server\HttpServer;
use Windwalker\Http\Server\PhpServer;

use function Windwalker\DI\create;
use function Windwalker\ref;

return [
    'factories' => [
        'servers' => [
            'http' => ref('di.servers.http'),
        ],
        'apps' => [
            'main' => ref('di.apps.main'),
        ],
        'console' => ref('di.console'),
    ],

    'di' => [
        'servers' => [
            'http' => create(
                HttpServer::class,
                adapter: create(PhpServer::class)
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
        'console' => static function (Container $container) {
            $console = new ConsoleApplication($container->createChild());
            $console->setAutoExit(false);
            $console->loadConfig(__DIR__ . '/app/console.php');
            $console->boot();
            return $console;
        }
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

<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App;

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Runtime\Runtime;
use Windwalker\Core\Service\ErrorService;
use Windwalker\Http\Event\RequestEvent;
use Windwalker\Http\Server\HttpServerInterface;
use Windwalker\Http\Server\SwooleHttpServer;

use function Windwalker\uid;

$_ENV['APP_ENV'] = 'dev';

$root = __DIR__ . '/..';

include __DIR__ . '/../vendor/autoload.php';

include $root . '/vendor/autoload.php';

include __DIR__ . '/../etc/define.php';

// Runtime::ipBlock(['dev'], env('DEV_ALLOW_IPS'));

Runtime::boot(WINDWALKER_ROOT, __DIR__);

Runtime::loadConfig(Runtime::getRootDir() . '/etc/runtime.php');

$container = Runtime::getContainer();

/** @var SwooleHttpServer $server */
/** @var WebApplication $app */
$server = $container->resolve('factories.servers.swoole');
$container->share(HttpServerInterface::class, $server);

$app = $container->resolve('factories.apps.main');
$app->boot();

$server->onRequest(function (RequestEvent $event) use ($app) {
    $appContext = $app->createContextFromServerEvent($event);

    try {
        $event->setResponse($app->runContext($appContext));
    } catch (\Throwable $e) {
        echo "[Error: {$e->getCode()}] " . $e->getMessage() . "\n";

        try {
            $error = $appContext->service(ErrorService::class);

            $error->handle($e);
        } catch (\Throwable $e) {
            echo '[Infinite loop in error handling]: ' . $e->getMessage() . "\n";
        }
    } finally {
        $event->setEndHandler(fn () => $app->stopContext($appContext));
    }
});

$server->listen('0.0.0.0', 9501);

$app->terminate();

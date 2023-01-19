<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Runtime\Runtime;
use Windwalker\Http\Event\RequestEvent;
use Windwalker\Http\Server\HttpServer;

$root = __DIR__ . '/..';

include __DIR__ . '/../vendor/autoload.php';

include $root . '/vendor/autoload.php';

include __DIR__ . '/../etc/define.php';

Runtime::ipBlock(['dev'], env('DEV_ALLOW_IPS'));

Runtime::boot(WINDWALKER_ROOT, __DIR__);

Runtime::loadConfig(Runtime::getRootDir() . '/etc/runtime.php');

$container = Runtime::getContainer();

/** @var HttpServer $server */
/** @var WebApplication $app */
$server = $container->resolve('factories.servers.http');
$app = $container->resolve('factories.apps.main');
$app->boot();
$server->getEventDispatcher()->addDealer($app->getEventDispatcher());

$server->onRequest(function (RequestEvent $event) use ($app) {
    $req = $event->getRequest();

    $event->setResponse($app->execute($req));
});

$server->listen();

$app->terminate();

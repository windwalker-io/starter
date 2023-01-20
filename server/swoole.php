<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App;

use Symfony\Component\Mime\MimeTypes;
use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Runtime\Runtime;
use Windwalker\Filesystem\Path;
use Windwalker\Http\Event\RequestEvent;
use Windwalker\Http\Response\Response;
use Windwalker\Http\Server\SwooleHttpServer;
use Windwalker\Stream\Stream;

use const Windwalker\Stream\READ_ONLY_FROM_BEGIN;

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
$app = $container->resolve('factories.apps.main');
$app->boot();
$server->getEventDispatcher()->addDealer($app->getEventDispatcher());

$server->onRequest(function (RequestEvent $event) use ($app) {
    $req = $event->getRequest();

    $path = $req->getUri()->getPath();

    if ($path === '/favicon.ico') {
        $event->setResponse(Response::fromString('', 200, []));
        return;
    }

    $abPath = $app->path('@public/' . $path);

    if (is_file($abPath)) {
        $mime = new MimeTypes();
        [$type] = $mime->getMimeTypes(Path::getExtension($abPath)) ?: ['x-empty'];

        $stream = new Stream($abPath, READ_ONLY_FROM_BEGIN);

        $event->setResponse(
            (new Response($stream, 200, []))
                ->withHeader('Content-Type', $type)
        );
        return;
    }

    $event->setResponse($app->execute($req));
});

$server->listen('0.0.0.0', 9501);

$app->terminate();

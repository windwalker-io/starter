<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

use Windwalker\Core\Runtime\Runtime;
use Windwalker\Http\Event\RequestEvent;
use Windwalker\Http\Server\HttpServer;

$root = __DIR__ . '/..';

if (!is_file($root . '/vendor/autoload.php')) {
    exit('Please run `composer install` First.');
}

include $root . '/vendor/autoload.php';

error_reporting(-1);

include __DIR__ . '/../etc/define.php';

Runtime::boot(WINDWALKER_ROOT, __DIR__);

Runtime::loadConfig(Runtime::getRootDir() . '/etc/runtime.php');

$container = Runtime::getContainer();

/** @var HttpServer $server */
$server = $container->resolve('server.http');

$server->on('request', function (RequestEvent $event) use ($container) {
    $req = $event->getRequest();

    /** @var \Windwalker\Core\Application\WebApplication $app */
    $app = $container->resolve('app.main');

    $app->addMiddleware(function ($req, $next) use ($app) {
        $app->service(\Windwalker\Core\Service\LoggerService::class)->error('error', 'werwwr');
        $db = $app->service(\Windwalker\Database\DatabaseAdapter::class);

        show(
            $db->select('*')
                ->from('articles')
                ->where('id', 1)
                ->all()
                ->dump(true)
        );

        return $next($req);
    });

    $event->setResponse($app->execute($req));
});

$server->listen();

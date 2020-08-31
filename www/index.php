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

Runtime::boot(dirname(__DIR__), __DIR__);

Runtime::loadConfig(Runtime::getRootDir() . '/etc/config.php');

$container = Runtime::getContainer();

/** @var HttpServer $server */
$server = $container->resolve(Runtime::get('server.servers.http'));

$server->on('request', function (RequestEvent $event) {
    $req = $event->getRequest();

    show($req);
});

$server->listen();

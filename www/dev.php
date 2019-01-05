<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

// Start composer
$root = __DIR__ . '/..';

if (!is_file($root . '/vendor/autoload.php')) {
    exit('Please run `composer install` First.');
}

include $root . '/vendor/autoload.php';
include_once $root . '/etc/define.php';

$config = require $root . '/etc/conf/dev.php';
$allowIps = (require $root . '/etc/conf/dev.php')['allow_ips'] ?? '';

if ($allowIps !== 'all') {
    $allowIps = array_merge(
        ['127.0.0.1', 'fe80::1', '::1'],
        array_map('trim', explode(',', $config['allow_ips'] ?? ''))
    );

    // Get allow remote ips from config.
    if (isset($_SERVER['HTTP_CLIENT_IP'])
        || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
        || !in_array(@$_SERVER['REMOTE_ADDR'], $allowIps, true)
    ) {
        header('HTTP/1.1 403 Forbidden');

        exit('Forbidden');
    }
}

// Start our application.
$app = new Windwalker\Web\DevApplication();

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();

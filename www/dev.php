<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

// For dev environment
$config = array(
	'127.0.0.1',
	'fe80::1',
	'::1'
);

if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	|| !(in_array(@$_SERVER['REMOTE_ADDR'], $config)))
{
	header('HTTP/1.0 403 Forbidden');

	exit('Forbidden');
}

// Start composer
$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload))
{
	exit('Please run `composer install` First.');
}

include_once $autoload;

include_once __DIR__ . '/../etc/define.php';

// Get allow remote ips from config.
\Windwalker\Windwalker::loadConfiguration($config = new \Windwalker\Registry\Registry);

if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	|| !(in_array(@$_SERVER['REMOTE_ADDR'], $config->get('dev.allow_ips', array()))))
{
	header('HTTP/1.1 403 Forbidden');

	exit('Forbidden');
}

// Start our application.
$app = new Windwalker\Web\DevApplication(\Windwalker\Ioc::factory());

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();

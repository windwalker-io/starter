<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload))
{
	exit('Please run <code>$ composer install</code> First.');
}

include_once $autoload;

include_once __DIR__ . '/../etc/define.php';

$app = new Windwalker\Web\Application;

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();

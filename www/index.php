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

define('WINDWALKER_ROOT',      realpath(__DIR__ . '/..'));
define('WINDWALKER_WWW',       WINDWALKER_ROOT . '/www');
define('WINDWALKER_TEMPLATE',  WINDWALKER_ROOT . '/templates');
define('WINDWALKER_SOURCE',    WINDWALKER_ROOT . '/src');
define('WINDWALKER_RESOURCES', WINDWALKER_ROOT . '/resources');
define('WINDWALKER_ETC',       WINDWALKER_ROOT . '/etc');

(new Windwalker\Application\Application)->execute();

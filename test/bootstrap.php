<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Http\Request\ServerRequestFactory;
use Windwalker\Test\TestApplication;

/**
 * The WindwalkerTestBootstrap class.
 *
 * @since  3.0
 */
class WindwalkerTestBootstrap
{
	/**
	 * Method to boot Windwalker Application and get rid of global conflicts.
	 *
	 * @return  void
	 */
	public function boot()
	{
		$autoload = __DIR__ . '/../vendor/autoload.php';

		if (!is_file($autoload))
		{
			exit('Please run <code>$ composer install</code> First.');
		}

		include_once $autoload;

		include_once __DIR__ . '/../etc/define.php';

		$uri = defined('WINDWALKER_TEST_URI') ? WINDWALKER_TEST_URI : 'http://windwalker.io/starter/flower/sakura';
		$path = defined('WINDWALKER_TEST_SCRIPT_PATH') ? WINDWALKER_TEST_SCRIPT_PATH : '/starter/';

		$uri = new \Windwalker\Uri\PsrUri($uri);

		$_SERVER['HTTP_HOST']   = $uri->getHost();
		$_SERVER['REQUEST_URI'] = $uri->getPath();
		$_SERVER['SCRIPT_NAME'] = $path;
		$_SERVER['PHP_SELF']    = $uri->getPath();

		$request = ServerRequestFactory::createFromGlobals($_SERVER);

		$app = new TestApplication($request);

		define('WINDWALKER_DEBUG', true);

		$_SERVER['HTTP_HOST'] = 'windwalker.io';

		$app->boot();
		$app->bootRouting();
	}
}

(new WindwalkerTestBootstrap)->boot();

<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa;

// use Symfony\Component\HttpFoundation\Session\Session;
use Windwalker\Database\DatabaseFactory;
use Windwalker\DI\Container;
use Windwalker\Session\Bag\AutoExpiredFlashBag;
use Windwalker\Session\Handler\PhpHandler;
use Windwalker\Session\Session;

/**
 * Class Factory
 *
 * @since 1.0
 */
class Factory
{
	/**
	 * Property instances.
	 *
	 * @var  array
	 */
	public static $container = null;

	/**
	 * Property db.
	 *
	 * @var  \Windwalker\Database\Driver\DatabaseDriver
	 */
	public static $db = null;

	/**
	 * Property app.
	 *
	 * @var  \Formosa\Application\Application
	 */
	public static $app = null;

	/**
	 * Property session.
	 *
	 * @var \Windwalker\Session\Session
	 */
	public static $session;

	/**
	 * getContainer
	 *
	 * @return  Container
	 */
	public static function getContainer()
	{
		if (empty(static::$container))
		{
			static::$container = new Container;
		}

		return static::$container;
	}

	/**
	 * getDbo
	 *
	 * @return  \Windwalker\Database\Driver\DatabaseDriver
	 */
	public static function getDbo()
	{
		if (empty(static::$db))
		{
			$app = static::getApplication();

			$option = array(
				'driver' => $app->get('database.driver'),
				'host' => $app->get('database.host'),
				'user' => $app->get('database.user'),
				'password' => $app->get('database.password'),
				'database' => $app->get('database.name'),
			);
			
			static::$db = DatabaseFactory::getDbo($option);
		}

		return static::$db;
	}

	/**
	 * getApp
	 *
	 * @throws  \RuntimeException
	 * @return  \Formosa\Application\Application
	 */
	public static function getApplication()
	{
		if (empty(static::$app))
		{
			throw new \RuntimeException('No application now.');
		}

		return static::$app;
	}

	/**
	 * getSession
	 *
	 * @return  Session
	 */
	public static function getSession()
	{
		if (empty(static::$session))
		{
			static::$session = new Session(new PhpHandler);

			static::$session->setCookie($_COOKIE);

			static::$session->start();
		}

		return static::$session;
	}
}
 
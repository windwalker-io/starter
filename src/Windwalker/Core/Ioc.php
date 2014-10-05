<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core;

use Windwalker\DI\Container;

/**
 * The Factory class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Ioc
{
	/**
	 * Property container.
	 *
	 * @var Container
	 */
	public static $container;

	/**
	 * Property subContainers.
	 *
	 * @var  Container[]
	 */
	public static $subContainers = array();

	/**
	 * getContainer
	 *
	 * @param string $name
	 *
	 * @return  Container
	 */
	public static function getContainer($name = null)
	{
		// No name, return root container.
		if (!$name)
		{
			if (!(self::$container instanceof Container))
			{
				self::$container = new Container;
			}

			return self::$container;
		}

		// Has name, we return children container.
		if (empty(self::$subContainers[$name]) || !(self::$subContainers[$name] instanceof Container))
		{
			self::$subContainers[$name] = new Container(static::getContainer());
		}

		return self::$subContainers[$name];
	}

	/**
	 * getApplication
	 *
	 * @return  \Windwalker\Application\Application
	 */
	public static function getApplication()
	{
		return static::get('application');
	}

	/**
	 * getConfig
	 *
	 * @return  \Windwalker\Registry\Registry
	 */
	public static function getConfig()
	{
		return static::get('config');
	}

	/**
	 * getEnvironment
	 *
	 * @return  \Windwalker\Environment\Web\WebEnvironment
	 */
	public static function getEnvironment()
	{
		return static::get('environment');
	}

	/**
	 * getInput
	 *
	 * @return  \Windwalker\IO\Input
	 */
	public static function getInput()
	{
		return static::get('input');
	}

	/**
	 * getSession
	 *
	 * @return  \Windwalker\Session\Session
	 */
	public static function getSession()
	{
		return static::get('session');
	}

	/**
	 * getCache
	 *
	 * @return  \Windwalker\Cache\Cache
	 */
	public static function getCache()
	{
		return static::get('cache');
	}

	/**
	 * getDB
	 *
	 * @return  \Windwalker\Database\Driver\DatabaseDriver
	 */
	public static function getDatabase()
	{
		return static::get('database');
	}

	/**
	 * getRouter
	 *
	 * @return  \Windwalker\Router\Router
	 */
	public static function getRouter()
	{
		return static::get('router');
	}

	/**
	 * getLanguage
	 *
	 * @return  \Windwalker\Language\Language
	 */
	public static function getLanguage()
	{
		return static::get('language');
	}

	/**
	 * getDebugger
	 *
	 * @return  \Whoops\Run
	 */
	public static function getDebugger()
	{
		return static::get('debugger');
	}

	/**
	 * getLogger
	 *
	 * @return  \Psr\Log\NullLogger|\Monolog\Logger
	 */
	public static function getLogger()
	{
		return static::get('logger');
	}

	/**
	 * get
	 *
	 * @param string $key
	 * @param bool   $forceNew
	 *
	 * @return  mixed
	 */
	protected static function get($key, $forceNew = false)
	{
		$container = static::getContainer();

		$config = $container->get('system.config');

		$key = $config->get('registry.' . $key, 'system.' . $key);

		if (!$container->exists($key))
		{
			return null;
		}

		return $container->get($key, $forceNew);
	}
}
 
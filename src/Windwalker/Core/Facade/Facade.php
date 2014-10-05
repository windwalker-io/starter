<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Facade;

use Windwalker\Core\Ioc;
use Windwalker\DI\Container;

/**
 * The AbstractFacade class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Facade
{
	/**
	 * Property key.
	 *
	 * @var  string
	 */
	protected static $key;

	/**
	 * Property group.
	 *
	 * @var string
	 */
	protected static $name;

	/**
	 * Property container.
	 *
	 * @var Container
	 */
	protected static $container;

	/**
	 * getInstance
	 *
	 * @return  mixed|object
	 */
	protected static function getInstance()
	{
		if (!static::$key)
		{
			throw new \LogicException('Key not set');
		}

		return static::getContainer()->get(static::$key);
	}

	/**
	 * Method to get property Container
	 *
	 * @return  Container
	 */
	protected static function getContainer()
	{
		if (!static::$container)
		{
			static::$container = Ioc::getContainer(static::$name);
		}

		return static::$container;
	}

	/**
	 * Method to set property container
	 *
	 * @param   Container $container
	 *
	 * @return  void
	 */
	public static function setContainer($container)
	{
		self::$container = $container;
	}
}
 
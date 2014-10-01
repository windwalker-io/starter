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
abstract class Factory
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
}
 
<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Router;

use Windwalker\Router\Matcher\MatcherInterface;
use Windwalker\Router\Router;

/**
 * The RouterFactory class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RouterFactory
{
	/**
	 * getInstance
	 *
	 * @param array  $routes
	 * @param string $matcher
	 *
	 * @return  Router
	 */
	public static function getInstance($routes = array(), $matcher = 'sequential')
	{
		return new Router(array(), static::getMatcher($matcher));
	}

	/**
	 * getMatcher
	 *
	 * @param   string  $matcher
	 *
	 * @return  MatcherInterface
	 */
	public static function getMatcher($matcher)
	{
		$class = sprintf('Windwalker\Router\Matcher\%sMatcher', ucfirst($matcher));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Router Matcher: %s not supported.', ucfirst($matcher)));
		}

		return new $class;
	}
}
 
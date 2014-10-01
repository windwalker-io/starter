<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\Core\Router\RestfulRouter;
use Windwalker\DI\Container;
use Windwalker\Router\Matcher\MatcherInterface;

/**
 * The RouterProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RouterProvider extends AbstractConfigServiceProvider
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 */
	public function register(Container $container)
	{
		$matcher = $this->config->get('routing.matcher', 'default');

		$closure = function(Container $container) use ($matcher)
		{
			$matcher = strtolower($matcher) == 'default' ? 'sequential' : $matcher;

			return new RestfulRouter(array(), $this->getMatcher($matcher));
		};

		$container->share('system.router', $closure)
			->alias('router', 'system.router');
	}

	/**
	 * getMatcher
	 *
	 * @param   string  $matcher
	 *
	 * @return  MatcherInterface
	 */
	protected function getMatcher($matcher)
	{
		$class = sprintf('Windwalker\Router\Matcher\%sMatcher', ucfirst($matcher));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Router Matcher: %s not supported.', ucfirst($matcher)));
		}

		return new $class;
	}
}
 
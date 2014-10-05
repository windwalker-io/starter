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
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Router\Matcher\MatcherInterface;

/**
 * The RouterProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RouterProvider implements ServiceProviderInterface
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
		$self = $this;

		$closure = function(Container $container) use ($self)
		{
			/** @var \Windwalker\Registry\Registry $config */
			$config = $container->get('system.config');

			$matcher = $config->get('routing.matcher', 'default');

			$matcher = strtolower($matcher) == 'default' ? 'sequential' : $matcher;

			return new RestfulRouter(array(), $self->getMatcher($matcher));
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
	public function getMatcher($matcher)
	{
		$class = sprintf('Windwalker\Router\Matcher\%sMatcher', ucfirst($matcher));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Router Matcher: %s not supported.', ucfirst($matcher)));
		}

		return new $class;
	}
}
 
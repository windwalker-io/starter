<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Session\Session;

/**
 * The SessionProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SessionProvider implements ServiceProviderInterface
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

			$handler = $config->get('session.handler', 'native');
			$options = $config->get('session.options', array());

			return new Session($self->getHandler($handler), null, null, null, $options);
		};

		$container->share('system.session', $closure)
			->alias('session', 'system.session');
	}

	/**
	 * getHandler
	 *
	 * @param string $handler
	 *
	 * @return  \Windwalker\Session\Handler\HandlerInterface
	 */
	public function getHandler($handler)
	{
		$class = sprintf('Windwalker\Session\Handler\%sHandler', ucfirst($handler));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Session handler: %s not supported', $class));
		}

		return new $class;
	}
}
 
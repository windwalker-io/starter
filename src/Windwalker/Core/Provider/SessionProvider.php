<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\DI\Container;
use Windwalker\Session\Session;

/**
 * The SessionProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SessionProvider extends AbstractConfigServiceProvider
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
		$handler = $this->config->get('session.handler', 'native');
		$options = $this->config->get('session.options', array());

		$closure = function($container) use ($handler, $options)
		{
			return new Session($this->getHandler($handler), null, null, null, $options);
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
	protected function getHandler($handler)
	{
		$class = sprintf('Windwalker\Session\Handler\%sHandler', ucfirst($handler));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Session handler: %s not supported', $class));
		}

		return new $class;
	}
}
 
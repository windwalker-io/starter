<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Provider;

use Windwalker\DI\Container;

/**
 * Class WhoopsProvider
 *
 * @since 1.0
 */
class WhoopsProvider extends AbstractConfigServiceProvider
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function register(Container $container)
	{
		if ($this->config->get('system.debug'))
		{
			$whoops = new \Whoops\Run;

			$handler = new \Whoops\Handler\PrettyPageHandler;

			$whoops->pushHandler($handler);

			$whoops->register();

			$container->share('whoops', $whoops);
			$container->share('whoops.handler', $handler);
		}
	}
}
 
<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\Core\Application\Console;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * The ConsoleProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ConsoleProvider implements ServiceProviderInterface
{
	/**
	 * Property app.
	 *
	 * @var Console
	 */
	protected $app;

	/**
	 * Class init.
	 *
	 * @param Console $app
	 */
	public function __construct(Console $app)
	{
		$this->app = $app;
	}

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 */
	public function register(Container $container)
	{
		// Input
		$container->share('system.io', $this->app->io)
			->alias('io', 'system.io');

		// Environment
//		$container->share('system.environment', $this->app->getEnvironment())
//			->alias('environment', 'system.environment');
//
//		$container->share('system.client', $this->app->getEnvironment()->getClient());
//		$container->share('system.server', $this->app->getEnvironment()->getServer());
	}
}
 
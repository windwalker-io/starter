<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Provider;

use Formosa\Factory;
use Windwalker\Database\DatabaseFactory;
use Windwalker\DataMapper\Adapter\DatabaseAdapter;
use Windwalker\DataMapper\Adapter\WindwalkerAdapter;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * Class WhoopsProvider
 *
 * @since 1.0
 */
class DatabaseProvider extends AbstractConfigServiceProvider
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
		$closure = function($container)
		{
			$option = array(
				'driver'   => $this->config->get('database.driver', 'mysql'),
				'host'     => $this->config->get('database.host', 'localhost'),
				'user'     => $this->config->get('database.user', 'root'),
				'password' => $this->config->get('database.password', ''),
				'database' => $this->config->get('database.name'),
				'prefix'   => $this->config->get('database.prefix', 'wind_'),
			);

			return DatabaseFactory::getDbo($option['driver'], $option);
		};

		$container->share('db', $closure);

		// For DataMapper
		DatabaseAdapter::setInstance(
			function() use ($container)
			{
				return new WindwalkerAdapter($container->get('db'));
			}
		);
	}
}
 
<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Provider;

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
class DatabaseProvider implements ServiceProviderInterface
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
		$closure = function(Container $container)
		{
			$config = $container->get('system.config');

			$option = array(
				'driver'   => $config->get('database.driver', 'mysql'),
				'host'     => $config->get('database.host', 'localhost'),
				'user'     => $config->get('database.user', 'root'),
				'password' => $config->get('database.password', ''),
				'database' => $config->get('database.name'),
				'prefix'   => $config->get('database.prefix', 'wind_'),
			);

			return DatabaseFactory::getDbo($option['driver'], $option);
		};

		$container->share('system.database', $closure)
			->alias('database', 'system.database')
			->alias('db', 'system.database');

		// For DataMapper
		DatabaseAdapter::setInstance(
			function() use ($container)
			{
				return new WindwalkerAdapter($container->get('db'));
			}
		);
	}
}
 
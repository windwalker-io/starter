<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Provider;

use Formosa\Factory;
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
		DatabaseAdapter::setInstance(
			function()
			{
				return new WindwalkerAdapter(Factory::getDbo());
			}
		);

		$container->share(
			'db',
			function()
			{
				return Factory::getDbo();
			}
		);
	}
}
 
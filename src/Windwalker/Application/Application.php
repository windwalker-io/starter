<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Application;

use Symfony\Component\Yaml\Yaml;
use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Provider\DatabaseProvider;
use Windwalker\Core\Provider\LoggerProvider;
use Windwalker\Core\Provider\RouterProvider;
use Windwalker\Core\Provider\SessionProvider;
use Windwalker\Core\Provider\WhoopsProvider;
use Windwalker\DI\Container;
use Windwalker\Registry\Registry;

/**
 * Class Application
 *
 * @since 1.0
 */
class Application extends WebApplication
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		parent::initialise();
	}

	/**
	 * registerProviders
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	protected function registerProviders(Container $container)
	{
		parent::registerProviders($container);

		$container
			->registerServiceProvider(new WhoopsProvider($this->config))
			->registerServiceProvider(new DatabaseProvider($this->config))
			->registerServiceProvider(new LoggerProvider($this->config))
			->registerServiceProvider(new RouterProvider($this->config))
			->registerServiceProvider(new SessionProvider($this->config));
	}

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @throws  \RuntimeException
	 * @return  void
	 */
	protected function loadConfiguration($config)
	{
		$file = WINDWALKER_ETC . '/config.yml';

		if (!is_file($file))
		{
			exit('Please copy config.dist.yml to config.yml');
		}

		$config->loadFile($file, 'yaml');
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  mixed
	 */
	protected function loadRoutingConfiguration()
	{
		return Yaml::parse(file_get_contents(WINDWALKER_ETC . '/routing.yml'));
	}
}
 
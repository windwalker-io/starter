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
use Windwalker\Core\Provider\CacheProvider;
use Windwalker\Core\Provider\DatabaseProvider;
use Windwalker\Core\Provider\LanguageProvider;
use Windwalker\Core\Provider\RouterProvider;
use Windwalker\Core\Provider\SessionProvider;
use Windwalker\Core\Provider\WhoopsProvider;
use Windwalker\DI\Container;
use Windwalker\Registry\Registry;
use Windwalker\SystemPackage\SystemPackage;

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
	public static function registerProviders(Container $container)
	{
		$container
			->registerServiceProvider(new WhoopsProvider)
			->registerServiceProvider(new DatabaseProvider)
			->registerServiceProvider(new RouterProvider)
			->registerServiceProvider(new LanguageProvider)
			->registerServiceProvider(new CacheProvider)
			->registerServiceProvider(new SessionProvider);
	}

	/**
	 * getPackages
	 *
	 * @return  array
	 */
	public static function getPackages()
	{
		return array(
			new SystemPackage
		);
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
 
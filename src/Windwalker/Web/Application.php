<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Web;

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Provider\CacheProvider;
use Windwalker\Core\Provider\DatabaseProvider;
use Windwalker\Core\Provider\EventProvider;
use Windwalker\Core\Provider\LanguageProvider;
use Windwalker\Core\Provider\RouterProvider;
use Windwalker\Core\Provider\SessionProvider;
use Windwalker\Core\Provider\WhoopsProvider;
use Windwalker\DI\Container;
use Windwalker\Registry\Registry;
use Windwalker\User\UserPackage;
use Windwalker\Windwalker;

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
		Windwalker::prepareSystemPath($this->config);

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
		/*
		 * Default Providers:
		 * -----------------------------------------
		 * This is some default service providers, we don't recommend to remove them,
		 * But you can replace with yours, Make sure all the needed container key has
		 * registered in your own providers.
		 */
		$container
			->registerServiceProvider(new WhoopsProvider)
			->registerServiceProvider(new EventProvider)
			->registerServiceProvider(new DatabaseProvider)
			->registerServiceProvider(new RouterProvider)
			->registerServiceProvider(new LanguageProvider)
			->registerServiceProvider(new CacheProvider)
			->registerServiceProvider(new SessionProvider);

		/*
		 * Custom Providers:
		 * -----------------------------------------
		 * You can add your own providers here. If you installed a 3rd party packages from composer,
		 * but this package need some init logic, create a service provider to do this and register it here.
		 */

		// Custom Providers here...
	}

	/**
	 * getPackages
	 *
	 * @return  array
	 */
	public function getPackages()
	{
		/*
		 * Get Global Packages
		 * -----------------------------------------
		 * If you want a package can be use in every applications (for example: Web and Console),
		 * set it in Windwalker\Windwalker object.
		 */
		$packages = Windwalker::getPackages();

		/*
		 * Get Packages for This Application
		 * -----------------------------------------
		 * If you want a package only use in this application or want to override a global package,
		 * set it here. Example: $packages[] = new Flower\FlowerPackage;
		 */

		// Your packages here...
		$packages[] = new UserPackage;

		return $packages;
	}

	/**
	 * Prepare execute hook.
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
	}

	/**
	 * Pose execute hook.
	 *
	 * @return  mixed
	 */
	protected function postExecute()
	{
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
		Windwalker::loadConfiguration($config);
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  mixed
	 */
	protected function loadRoutingConfiguration()
	{
		return Windwalker::loadRouting();
	}
}
 
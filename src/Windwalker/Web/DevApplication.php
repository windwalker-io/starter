<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Web;

use Symfony\Component\Yaml\Yaml;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Registry\Registry;
use Windwalker\Core\Provider;

/**
 * The DevApplication class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DevApplication extends Application
{
	/**
	 * Property mode.
	 *
	 * @var  string
	 */
	public $mode = 'dev';

	/**
	 * loadProviders
	 *
	 * @return  ServiceProviderInterface[]
	 */
	public static function loadProviders()
	{
		/*
		 * Get Global Providers
		 * -----------------------------------------
		 * If you want a provider can be used in every applications (for example: Web and Console),
		 * set it in Windwalker\Windwalker object.
		 */
		$providers = parent::loadProviders();

		// Custom Providers here...
		$providers['debug'] = new Provider\WhoopsProvider;

		return $providers;
	}

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @return  void
	 */
	protected function loadConfiguration(Registry $config)
	{
		parent::loadConfiguration($config);

		$config->loadFile(WINDWALKER_ETC . '/dev/config.yml', 'yaml');
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  array
	 */
	protected function loadRoutingConfiguration()
	{
		$routes = parent::loadRoutingConfiguration();

		return array_merge($routes, Yaml::parse(file_get_contents(WINDWALKER_ETC . '/dev/routing.yml')));
	}
}

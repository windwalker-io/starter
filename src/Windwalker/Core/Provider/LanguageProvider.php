<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Language\Language;
use Windwalker\Language\Loader\FileLoader;

/**
 * The LanguageProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LanguageProvider implements ServiceProviderInterface
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
			/** @var \Windwalker\Registry\Registry $config */
			$config = $container->get('system.config');

			$debug     = $config['system.debug'] ? : false;
			$langDebug = $config['language.debug'] ? : false;
			$path      = $config['language.path'] ? : 'resources/languages';

			$path = $container->get('environment')->server->getRoot() . '/../' . $path;

			if (is_dir($path))
			{
				$path = realpath($path);
			}

			$loader = new FileLoader(array($path));

			$language = new Language(
				$config->get('language.locale', 'en-GB'),
				$config->get('language.default', 'en-GB'),
				$loader
			);

			return $language->setDebug(($debug && $langDebug));
		};

		$container->share('system.language', $closure)->alias('language', 'system.language');
	}
}
 
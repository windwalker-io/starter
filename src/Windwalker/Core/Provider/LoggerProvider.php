<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Provider;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Log\NullLogger;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * Class LoggerProvider
 *
 * @since 1.0
 */
class LoggerProvider implements ServiceProviderInterface
{
	/**
	 * Property config.
	 *
	 * @var \Windwalker\Registry\Registry
	 */
	private $config;

	/**
	 * Class init.
	 *
	 * @param $config
	 */
	public function __construct($config)
	{
		$this->config = $config;
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
		if (!class_exists('Monolog\Logger') || $this->config->get('system.debug'))
		{
			$log = function($container)
			{
				return new NullLogger;
			};
		}
		else
		{
			$log = function($container)
			{
				$level = $this->config->get('system.debug') ? Logger::DEBUG : Logger::WARNING;

				$log = new Logger('sql');
				$stream = new StreamHandler(FORMOSA_ETC . '/logs/debug.log', $level);
				$log->pushHandler($stream);
				$log->pushProcessor(new PsrLogMessageProcessor);
			};
		}

		$container->share('logger', $log);
	}
}
 
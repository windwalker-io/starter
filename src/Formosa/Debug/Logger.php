<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Debug;

use Formosa\Utilities\Classes\MultiSingletonTrait;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as Monolog;
use Monolog\Processor\PsrLogMessageProcessor;

/**
 * Class Logger
 *
 * @since 1.0
 */
class Logger
{
	use MultiSingletonTrait;

	/**
	 * getInstance
	 *
	 * @param string $name
	 * @param string $file
	 * @param int    $level
	 *
	 * @return  Monolog
	 */
	public static function getInstance($name, $file = null, $level = null)
	{
		if (static::hasInstance($name))
		{
			return MultiSingletonTrait::getInstance($name);
		}

		$log = new Monolog($name);
		$stream = new StreamHandler($file, $level);
		$log->pushHandler($stream);
		$log->pushProcessor(new PsrLogMessageProcessor);

		return static::setInstance($name, $log);
	}
}
 
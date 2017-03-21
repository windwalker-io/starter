<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Profilter;

use Windwalker\Profiler\Profiler;

/**
 * The CoreProfiler class.
 *
 * @since  {DEPLOY_VERSION}
 */
class CoreProfiler
{
	/**
	 * Property instance.
	 *
	 * @var  Profiler
	 */
	protected static $instance;

	/**
	 * mark
	 *
	 * @param string $name
	 * @param array  $data
	 *
	 * @return  Profiler
	 */
	public static function mark($name, $data = [])
	{
		return static::getInstance()->mark($name, $data);
	}

	/**
	 * getInstance
	 *
	 * @return  Profiler
	 */
	public static function getInstance()
	{
		if (!static::$instance)
		{
			static::$instance = new Profiler('Test');
		}

		return static::$instance;
	}
}

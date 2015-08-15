<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Helper;

use Windwalker\Registry\Registry;
use Windwalker\Utilities\ArrayHelper;

/**
 * The ComposerInformation class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ComposerInformation
{
	/**
	 * Property cache.
	 *
	 * @var  Registry
	 */
	protected static $lock;

	/**
	 * Property json.
	 *
	 * @var Registry
	 */
	protected static $json;

	/**
	 * getLock
	 *
	 * @return  Registry
	 */
	public static function getLock()
	{
		if (!static::$lock)
		{
			$file = WINDWALKER_ROOT . '/composer.lock';

			static::$lock = new Registry(is_file($file) ? file_get_contents($file) : null);
		}

		return static::$lock;
	}

	/**
	 * getJson
	 *
	 * @return  Registry
	 */
	public static function getJson()
	{
		if (!static::$json)
		{
			$file = WINDWALKER_ROOT . '/composer.json';

			static::$json = new Registry(is_file($file) ? file_get_contents($file) : null);
		}

		return static::$json;
	}

	/**
	 * getInstalledVersion
	 *
	 * @param   string  $package
	 *
	 * @return  string
	 */
	public static function getInstalledVersion($package)
	{
		$composer = ComposerInformation::getLock();

		$data = ArrayHelper::query($composer['packages'], array('name' => $package));

		if (isset($data[0]['version']))
		{
			return $data[0]['version'];
		}

		return null;
	}
}

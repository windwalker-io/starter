<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Helper\Set;

/**
 * Class HelperSet
 *
 * @since 1.0
 */
class HelperSet
{
	/**
	 * Property helpers.
	 *
	 * @var  array
	 */
	protected static $helpers = array();

	/**
	 * __get
	 *
	 * @param string $name
	 *
	 * @return \Formosa\Helper\AbstractHelper
	 */
	public function __get($name)
	{
		if (empty(static::$helpers[$name]))
		{
			$class = 'Formosa\\Helper\\' . ucfirst($name) . 'Helper';

			if (!class_exists($class))
			{
				return false;
			}

			static::$helpers[$name] = new $class($this);
		}

		return static::$helpers[$name];
	}

	/**
	 * __isset
	 *
	 * @param string $key
	 *
	 * @return bool
	 */
	public function __isset($key)
	{
		if (!$this->$key)
		{
			return false;
		}

		return true;
	}
}
 
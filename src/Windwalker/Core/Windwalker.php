<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core;

/**
 * The Windwalker class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Windwalker
{
	/**
	 * getPath
	 *
	 * @return  string
	 */
	public static function getPath()
	{
		return __DIR__;
	}
}
 
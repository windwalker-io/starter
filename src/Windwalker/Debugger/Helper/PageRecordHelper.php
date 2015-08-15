<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Helper;

/**
 * The DebuggerHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PageRecordHelper
{
	/**
	 * getFolderName
	 *
	 * @param   string  $id
	 *
	 * @return  string
	 */
	public static function getFolderName($id)
	{
		return substr($id, 0, 4);
	}

	/**
	 * getFile
	 *
	 * @param   string  $id
	 *
	 * @return  string
	 */
	public static function getFile($id)
	{
		return static::getFolder($id) . '/' . $id;
	}

	/**
	 * getFolder
	 *
	 * @param   string  $id
	 *
	 * @return  string
	 */
	public static function getFolder($id)
	{
		return WINDWALKER_CACHE . '/profiler/' . static::getFolderName($id);
	}
}

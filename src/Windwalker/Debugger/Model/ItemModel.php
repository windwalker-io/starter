<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Model;

use Windwalker\Core\Model\Model;
use Windwalker\Core\Object\NullObject;
use Windwalker\Data\Data;
use Windwalker\Debugger\Helper\PageRecordHelper;

/**
 * The ItemModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ItemModel extends Model
{
	/**
	 * getItem
	 *
	 * @param   string  $id
	 *
	 * @return  array
	 */
	public function getItem($id)
	{
		$file = PageRecordHelper::getFile($id);

		if (!is_file($file))
		{
			return null;
		}

		$item = unserialize(file_get_contents($file));

		$item = new Data((array) $item);

		if (!$item->profiler)
		{
			$item->profiler = new NullObject;
		}

		if (!$item->collector)
		{
			$item->collector = new NullObject;
		}

		$item->id = $id;

		return $item;
	}

	/**
	 * hasItem
	 *
	 * @param   string  $id
	 *
	 * @return  boolean
	 */
	public function hasItem($id)
	{
		$file = PageRecordHelper::getFile($id);

		return is_file($file);
	}
}

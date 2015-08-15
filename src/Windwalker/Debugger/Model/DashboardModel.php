<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Model;

use Windwalker\Core\Model\Model;
use Windwalker\Filesystem\Iterator\RecursiveDirectoryIterator;

/**
 * The DashboardModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DashboardModel extends Model
{
	/**
	 * getItems
	 *
	 * @return array
	 */
	public function getItems()
	{
		$state = $this->state;

		return $this->fetch('items', function() use ($state)
		{
			$dir = WINDWALKER_CACHE . '/profiler';

			if (!is_dir($dir))
			{
				return array();
			}

			$limit = $state->get('list.limit', 100);

			$files = new \RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
			$items = array();

			/** @var \SplFileInfo $file */
			foreach ($files as $file)
			{
				$item = unserialize(file_get_contents($file->getPathname()));

				$item['id'] = $file->getBasename();

				$items[$file->getMTime()] = $item;
			}

			krsort($items);

			$items = array_slice($items, 0, $limit);

			return $items;
		});
	}

	/**
	 * getLastItem
	 *
	 * @return  array
	 */
	public function getLastItem()
	{
		$items = $this->getItems();

		return array_shift($items);
	}
}

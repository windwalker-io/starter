<?php
/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Main\View\Page;

use Windwalker\Core\View\StructureView;
use Windwalker\Structure\Structure;

/**
 * The PageJsonView class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PageJsonView extends StructureView
{
	/**
	 * prepareData
	 *
	 * @param Structure $registry
	 *
	 * @return  void
	 */
	protected function prepareData($registry)
	{
		$registry['items'] = [1, 2, 3];
	}
}

<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Sakuras;

use Phoenix\Controller\Batch\BatchDelegationController;

/**
 * The UpdateController class.
 *
 * @since  1.0
 */
class BatchController extends BatchDelegationController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'sakuras';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'sakura';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'sakuras';
}

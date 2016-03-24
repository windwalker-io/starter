<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Front\Model;

use Front\Mapper\SakuraMapper;
use Phoenix\Model\ItemModel;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;

/**
 * The SakuraModel class.
 * 
 * @since  1.0
 */
class SakuraModel extends ItemModel
{
	/**
	 * postGetItem
	 *
	 * @param Data $item
	 *
	 * @return  void
	 */
	protected function postGetItem(Data $item)
	{
	}
}

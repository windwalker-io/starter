<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\View\Helper;

/**
 * The GridHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GridHelper extends AbstractHelper
{
	/**
	 * getBooleanIcon
	 *
	 * @param integer $value
	 *
	 * @return  string
	 */
	public function getBooleanIcon($value)
	{
		$icon = $value ? 'ok-sign' : 'remove-sign';

		$color = $value ? 'text-success' : 'text-danger';

		return '<span class="glyphicon glyphicon-' . $icon . ' ' . $color . '"></span>';
	}
}
 
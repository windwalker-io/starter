<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Helper;

/**
 * Class AbstractHelper
 *
 * @since 1.0
 */
class AbstractHelper
{
	/**
	 * Property parent.
	 *
	 * @var  Helper
	 */
	protected $parent = null;

	/**
	 * Class init.
	 *
	 * @param Helper $parent
	 */
	public function __construct(Helper $parent = null)
	{
		$this->parent = $parent;
	}
}
 
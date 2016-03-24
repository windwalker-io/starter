<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Front\View\Sakuras;

use Phoenix\View\ListView;

/**
 * The SakurasHtmlView class.
 * 
 * @since  1.0
 */
class SakurasHtmlView extends ListView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'sakuras';

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
	}

	/**
	 * setTitle
	 *
	 * @param string $title
	 *
	 * @return  static
	 */
	public function setTitle($title = null)
	{
		return parent::setTitle($title);
	}
}

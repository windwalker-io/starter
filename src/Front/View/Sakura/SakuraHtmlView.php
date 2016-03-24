<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Front\View\Sakura;

use Phoenix\View\ItemView;

/**
 * The SakuraHtmlView class.
 * 
 * @since  1.0
 */
class SakuraHtmlView extends ItemView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'sakura';

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

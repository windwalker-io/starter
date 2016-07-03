<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\View\Dashboard;

use Phoenix\View\AbstractPhoenixHtmView;

/**
 * The DashboardHtmlView class.
 * 
 * @since  1.0
 */
class DashboardHtmlView extends AbstractPhoenixHtmView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'dashboard';

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);
	}

	/**
	 * setTitle
	 *
	 * @param string $title
	 *
	 * @return  static
	 */
	public function setTitle($title = 'Dashboard')
	{
		return parent::setTitle($title);
	}
}

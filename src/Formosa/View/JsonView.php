<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\View;

use Joomla\Registry\Registry;

/**
 * Class JsonView
 *
 * @since 1.0
 */
class JsonView extends HtmlView
{
	/**
	 * Property data.
	 *
	 * @var  \Joomla\Registry\Registry
	 */
	protected $data = null;

	/**
	 * getData
	 *
	 * @return  \Joomla\Registry\Registry
	 */
	public function getData()
	{
		if (!$this->data)
		{
			$this->data = new Registry;
		}

		return $this->data;
	}

	/**
	 * setData
	 *
	 * @param   \Joomla\Registry\Registry $data
	 *
	 * @return  $this  Return self to support chaining.
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * prepareData
	 *
	 * @param \Joomla\Registry\Registry $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
	}

	/**
	 * render
	 *
	 * @return  string
	 */
	public function render()
	{
		$data = $this->getData();

		$this->prepareData($data);

		return (string) $data;
	}
}
 
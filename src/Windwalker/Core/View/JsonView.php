<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\View;

use Windwalker\Registry\Registry;

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
	 * @var  \Windwalker\Registry\Registry
	 */
	protected $data = null;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
	}

	/**
	 * getData
	 *
	 * @return  \Windwalker\Registry\Registry
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
	 * @param   \Windwalker\Registry\Registry $data
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
	 * @param \Windwalker\Registry\Registry $data
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
 
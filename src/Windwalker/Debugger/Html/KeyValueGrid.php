<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Html;

use Windwalker\Html\Grid;

/**
 * The KeyValueGrid class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class KeyValueGrid extends Grid
{
	/**
	 * create
	 *
	 * @param string $name
	 * @param array  $options
	 *
	 * @return  static
	 */
	public static function create($name, $options = array())
	{
		return new static($name, $options);
	}

	/**
	 * Class init.
	 *
	 * @param string $name
	 * @param array  $options
	 */
	public function __construct($name, $options = array())
	{
		if (!isset($options['class']))
		{
			$options['class'] = 'data-' . $name . ' table table-bordered';
		}

		parent::__construct($options);

		$this->setColumns(array('key', 'value'))
			->addRow(array(), static::ROW_HEAD)
			->setRowCell('key', 'Key', array())
			->setRowCell('value', 'Value');
	}

	/**
	 * addItem
	 *
	 * @param string $key
	 * @param string $value
	 *
	 * @return  static
	 */
	public function addItem($key, $value = null)
	{
		$this->addRow()
			->setRowCell('key', $key)
			->setRowCell('value', $value);

		return $this;
	}
}

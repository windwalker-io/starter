<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\Debugger\Html;

use Windwalker\Html\Grid\KeyValueGrid;

/**
 * The BootstrapKeyValueGrid class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BootstrapKeyValueGrid extends KeyValueGrid
{
	/**
	 * Class init.
	 *
	 * @param array $options
	 */
	public function __construct($options = array())
	{
		if (!isset($options['class']))
		{
			$options['class'] = 'table table-bordered';
		}

		parent::__construct($options);
	}

	/**
	 * addHeader
	 *
	 * @param string $keyTitle
	 * @param string $valueTitle
	 * @param array  $options
	 *
	 * @return  static
	 */
	public function addHeader($keyTitle = 'Key', $valueTitle = 'Value', $options = array())
	{
		if (!isset($options[static::COL_KEY]['width']))
		{
			$options[static::COL_KEY]['width'] = '30%';
		}

		return parent::addHeader($keyTitle, $valueTitle, $options);
	}

	/**
	 * addTitle
	 *
	 * @param string $name
	 * @param array  $options
	 *
	 * @return  static
	 */
	public function addTitle($name, $options = array())
	{
		if (!isset($options[static::ROW]['class']))
		{
			$options[static::ROW]['class'] = 'active';
		}

		return parent::addTitle($name, $options);
	}
}

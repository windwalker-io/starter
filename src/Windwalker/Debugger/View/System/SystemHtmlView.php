<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\System;

use Windwalker\Debugger\View\AbstractDebuggerHtmlView;
use Windwalker\Registry\Registry;

/**
 * The SystemHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SystemHtmlView extends AbstractDebuggerHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data->collector = $data->item['collector'];
	}
}

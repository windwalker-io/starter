<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\Database;

use Windwalker\Data\Data;
use Windwalker\Debugger\Helper\TimelineHelper;
use Windwalker\Debugger\View\AbstractDebuggerHtmlView;

/**
 * The SystemHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DatabaseHtmlView extends AbstractDebuggerHtmlView
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
		$profiler = $data->item['profiler'];
		$data->collector = $collector = $data->item['collector'];

		// Information
		$data->options = new Data($collector['database.info']);

		// Find system process points
		$queries = $data->collector['database.queries'];

		$data->queryProcess = TimelineHelper::prepareQueryTimeline($queries);
	}
}

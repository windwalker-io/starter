<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\Timeline;

use Windwalker\Debugger\View\AbstractDebuggerHtmlView;
use Windwalker\Html\Grid;
use Windwalker\Profiler\Point\Point;
use Windwalker\Profiler\Profiler;
use Windwalker\Registry\Registry;

/**
 * The SystemHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TimelineHtmlView extends AbstractDebuggerHtmlView
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

		$points = $profiler->getPoints();

		$data->points = array();

		/** @var Point $point */
		foreach ($points as $point)
		{
			$collector = $point->getData();

			if ($collector['tag'] != 'system.process')
			{
				continue;
			}

			$data->points[$point->getName()] = $point;
		}

		$data->profiler = new Profiler('system', null, $data->points);

		$timeline = array();

		$lastName = 'start';

		foreach ($data->points as $name => $point)
		{
			$timeline[$name] = array(
				// Second to ms
				'total_time'   => $data->profiler->getTimeBetween('start', $name) * 1000,
				'time'         => $data->profiler->getTimeBetween($lastName, $name) * 1000,
				'total_memory' => $data->profiler->getMemoryBetween('start', $name) / 1048576,
				'memory'       => $data->profiler->getMemoryBetween($lastName, $name) / 1048576,
			);

			$lastName = $name;
		}

		$data->timeline = $timeline;
	}
}

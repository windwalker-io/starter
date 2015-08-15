<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Helper;

use Windwalker\Core\Frontend\Bootstrap;
use Windwalker\Profiler\Point\Point;
use Windwalker\Profiler\Profiler;

/**
 * The TimelineHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TimelineHelper
{
	/**
	 * getLabelColor
	 *
	 * @param   float  $value
	 * @param   float  $avgValue
	 *
	 * @return  string
	 */
	public static function getTextColor($value, $avgValue)
	{
		if ($value > $avgValue * 2)
		{
			return Bootstrap::getColorClasses(Bootstrap::COLOR_DANGER);
		}
		elseif ($value > $avgValue * 1.5)
		{
			return Bootstrap::getColorClasses(Bootstrap::COLOR_WARNING);
		}
		elseif ($value < $avgValue / 2)
		{
			return Bootstrap::getColorClasses(Bootstrap::COLOR_SUCCESS);
		}
		else
		{
			return Bootstrap::getColorClasses(Bootstrap::COLOR_INFO);
		}
	}

	/**
	 * getPoints
	 *
	 * @param Point[] $points
	 * @param string  $tag
	 *
	 * @return  Point[]
	 */
	public static function getPoints(array $points, $tag = null)
	{
		$set = array();

		foreach ($points as $point)
		{
			$collector = $point->getData();

			if ($tag && $collector['tag'] != $tag)
			{
				continue;
			}

			$set[$point->getName()] = $point;
		}

		return $set;
	}

	/**
	 * preparePoints
	 *
	 * @param array $points
	 * @param null  $tag
	 *
	 * @return  array
	 */
	public static function prepareTimeline(array $points, $tag = null)
	{
		$set = static::getPoints($points, $tag);

		$profiler = new Profiler('system', null, $set);

		// Prepare timeline data
		$timeline = array();

		$lastName = 'start';

		// Count full time
		$fullTime = 0;
		$fullMemory = 0;

		foreach ($set as $name => $point)
		{
			$totalTime['value'] = $profiler->getTimeBetween('start', $name) * 1000;

			$time['value'] = $profiler->getTimeBetween($lastName, $name) * 1000;

			$totalMemory['value'] = $profiler->getMemoryBetween('start', $name) / 1048576;

			$memory['value'] = $profiler->getMemoryBetween($lastName, $name) / 1048576;

			$timeline[$name] = array(
				'total_time'   => $totalTime,
				'time'         => $time,
				'total_memory' => $totalMemory,
				'memory'       => $memory,
				'data'         => $point->getData()
			);

			$lastName = $name;
			$fullTime = $totalTime['value'];
			$fullMemory = $totalMemory['value'];
		}

		foreach ($timeline as &$item)
		{
			$item['total_time']['style']   = Bootstrap::getColorClasses(Bootstrap::COLOR_DEFAULT);
			$item['time']['style']         = TimelineHelper::getTextColor($item['time']['value'], $fullTime / count($set));
			$item['total_memory']['style'] = Bootstrap::getColorClasses(Bootstrap::COLOR_DEFAULT);
			$item['memory']['style']       = TimelineHelper::getTextColor($item['memory']['value'], $fullMemory / count($set));
		}

		return array(
			'tag'         => $tag,
			'timeline'    => $timeline,
			'full_time'   => $fullTime,
			'avg_time'    => $fullTime / count($set),
			'full_memory' => $fullMemory,
			'avg_memory'  => $fullMemory / count($set)
		);
	}
}

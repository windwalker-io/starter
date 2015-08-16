<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Helper;

use Windwalker\Core\Frontend\Bootstrap;
use Windwalker\Core\Object\NullObject;
use Windwalker\Data\Data;
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
	public static function getStateColor($value, $avgValue)
	{
		if ($value > $avgValue * 2)
		{
			return 'danger';
		}
		elseif ($value > $avgValue * 1.5)
		{
			return 'warning';
		}
		elseif ($value < $avgValue / 2)
		{
			return 'success';
		}
		else
		{
			return 'info';
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
	 * @param Point[] $points
	 * @param string  $tag
	 *
	 * @return  array
	 */
	public static function prepareTimeline(array $points, $tag = null)
	{
		if (!$points)
		{
			return new NullObject;
		}

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
			$item['total_time']['style']   = 'default';
			$item['time']['style']         = TimelineHelper::getStateColor($item['time']['value'], $fullTime / count($set));
			$item['total_memory']['style'] = 'default';
			$item['memory']['style']       = TimelineHelper::getStateColor($item['memory']['value'], $fullMemory / count($set));
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

	/**
	 * prepareQueryTimeline
	 *
	 * @param Data[] $queries
	 *
	 * @return  array
	 */
	public static function prepareQueryTimeline(array $queries)
	{
		if (!$queries)
		{
			return new NullObject;
		}

		// Prepare timeline data
		$timeline = array();

		foreach ($queries as $i => $data)
		{
			$time['value'] = abs($data['time']['start'] - $data['time']['end']) * 1000;
			$time['style'] = static::getStateColor($time['value'], 15);

			$memory['value'] = abs($data['memory']['start'] - $data['memory']['end']) / 1048576;
			$memory['style'] = static::getStateColor($memory['value'], 0.01);

			$timeline[$data['serial']] = array(
				'time'   => $time,
				'memory' => $memory,
				'data'   => $data
			);
		}

		return $timeline;
	}
}

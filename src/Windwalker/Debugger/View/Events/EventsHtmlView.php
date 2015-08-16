<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\Events;

use Windwalker\Debugger\View\AbstractDebuggerHtmlView;
use Windwalker\Html\Grid\Grid;
use Windwalker\Registry\Registry;

/**
 * The SystemHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class EventsHtmlView extends AbstractDebuggerHtmlView
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

		$data->eventExecuted = $data->collector['event.executed'];
		$data->eventListeners = $data->collector['event.listeners'];

		// Executed Events
		$events = array();

		foreach ((array) $data->eventExecuted as $event)
		{
			foreach ($event['listeners'] as $listener)
			{
				$id = $event['event'] . '.' . implode('::', (array) $listener);

				if (!isset($events[$id]))
				{
					$events[$id] = array(
						'name'     => $event['event'],
						'times'    => 0,
						'listener' => implode('::', (array) $listener)
					);
				}

				$events[$id]['times']++;
			}
		}

		$data->executed = $events;

		// Event No executed
		$events = array();

		foreach ((array) $data->eventListeners as $name => $listeners)
		{
			foreach ($listeners as $listener)
			{
				$id = $name . '.' . implode('::', (array) $listener);

				if (array_key_exists($id, $data->executed))
				{
					continue;
				}

				$events[$id] = array(
					'name'     => $name,
					'times'    => 0,
					'listener' => implode('::', (array) $listener)
				);
			}
		}

		$data->noExecuted = $events;
	}
}

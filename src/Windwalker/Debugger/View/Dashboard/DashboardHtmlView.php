<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\Dashboard;

use Windwalker\Core\DateTime\DateTime;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\Debugger\View\AbstractDebuggerHtmlView;

/**
 * The DashboardHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DashboardHtmlView extends AbstractDebuggerHtmlView
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
		$router = $this->getPackage()->getRouter();

		$data->items = $this->model->getItems();

		foreach ($data->items as $k => $item)
		{
			$item = new Data($item);
			$collector = $item['collector'];

			$item->url  = $collector['uri']['full'];
			$item->link = $router->html('system', array('id' => $item->id));
			$item->method = $collector['method'];
			$item->ip   = $collector['ip'];
			$item->time = $collector['time'];

			$item->status = $collector['http.status'];

			if ($item->status == 200)
			{
				$item->status_style = 'label label-success';
			}
			elseif (in_array($item->status, array(301, 302, 303)))
			{
				$item->status_style = 'label label-warning';
			}
			else
			{
				$item->status_style = 'label label-danger';
			}

			$item->exception = new Data($collector['exception']);

			$data->items[$k] = $item;
		}
	}
}

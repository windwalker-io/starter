<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View\Routing;

use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\Debugger\View\AbstractDebuggerHtmlView;
use Windwalker\Router\Route;
use Windwalker\String\StringHelper;

/**
 * The SystemHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RoutingHtmlView extends AbstractDebuggerHtmlView
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
		$data->routes = new DataSet;
		$data->matchedRoute = $data->collector['route.matched'];

		/** @var Route $route */
		foreach ($data->collector['routes'] as $name => $route)
		{
			list($packageName, $routeName) = StringHelper::explode(':', $name, 2, 'array_unshift');

			$data->routes[] = new Data(array(
				'package'   => $packageName,
				'name'      => $routeName,
				'pattern'   => $route->getPattern(),
				'compiled'  => $route->getRegex(),
				'variables' => $route->getVariables(),
				'methods'   => $route->getAllowMethods(),
				'extra'     => $route->getExtra(),
				'matched'   => $routeName == $data->matchedRoute->getName()
			));
		}
	}
}

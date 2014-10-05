<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\View\Helper;

use Joomla\Date\Date;
use Windwalker\Core\Ioc;
use Windwalker\Core\View\Helper\Set\HelperSet;

/**
 * Class RendererHelper
 *
 * @since 1.0
 */
class ViewHelper extends AbstractHelper
{
	/**
	 * getGlobalVariables
	 *
	 * @return  array
	 */
	public static function getGlobalVariables()
	{
		$container = Ioc::getContainer();

		return array(
			'uri' => $container->get('uri'),
			'app' => $container->get('system.application'),
			'container' => Ioc::getContainer(),
			'helper' => new HelperSet,
			'flash' => $container->get('session')->getFlashBag()->takeAll(),
			'datetime' => new Date('now', new \DateTimeZone($container->get('config')->get('system.timezone', 'UTC')))
		);
	}
}
 
<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\View\Helper;

use Formosa\Factory;
use Formosa\Helper\Set\HelperSet;
use Windwalker\Date\DateTime;

/**
 * Class RendererHelper
 *
 * @since 1.0
 */
class ViewHelper
{
	/**
	 * getGlobalVariables
	 *
	 * @return  array
	 */
	public static function getGlobalVariables()
	{
		$app = Factory::getApplication();

		return array(
			'uri' => $app->get('uri'),
			'app' => $app,
			'container' => Factory::getContainer(),
			'helper' => new HelperSet,
			'flash' => Factory::getSession()->getFlashBag()->takeAll(),
			'datetime' => new DateTime('now', new \DateTimeZone($app->get('system.timezone', 'UTC')))
		);
	}
}
 
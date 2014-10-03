<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\View;

use Windwalker\Renderer\BladeRenderer;

/**
 * Class TwigHtmlView
 *
 * @since 1.0
 */
class BladeHtmlView extends HtmlView
{
	/**
	 * Class init.
	 *
	 * @param array             $data
	 * @param BladeRenderer     $renderer
	 */
	public function __construct($data = array(), BladeRenderer $renderer = null)
	{
		$renderer = $renderer ? : new BladeRenderer(null, array('cache_path' => WINDWALKER_CACHE . '/view'));

		parent::__construct($data, $renderer);
	}
}
 
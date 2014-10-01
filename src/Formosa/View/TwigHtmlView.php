<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\View;

use Windwalker\Renderer\TwigRenderer;

/**
 * Class TwigHtmlView
 *
 * @since 1.0
 */
class TwigHtmlView extends HtmlView
{
	/**
	 * Class init.
	 *
	 * @param array             $data
	 * @param \SplPriorityQueue $paths
	 */
	public function __construct($data = array(), \SplPriorityQueue $paths = null)
	{
		parent::__construct($data, new TwigRenderer($paths));
	}

	/**
	 * getLayout
	 *
	 * @return  string
	 */
	public function getLayout()
	{
		return parent::getLayout() . '.twig';
	}
}
 
<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\View\Page;

use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Core\View\HtmlView;

/**
 * Class PageHtmlView
 *
 * @since 1.0 
 */
class PageHtmlView extends HtmlView
{
	protected $renderer = RendererHelper::ENGINE_EDGE;

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
	}
}

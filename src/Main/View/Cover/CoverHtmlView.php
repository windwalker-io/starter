<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Main\View\Cover;

use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Core\View\HtmlView;

/**
 * The CoverHtmlView class.
 *
 * @since  {DEPLOY_VERSION}
 */
class CoverHtmlView extends HtmlView
{
	/**
	 * Property renderer.
	 *
	 * @var  string
	 */
	protected $renderer = RendererHelper::EDGE;
}

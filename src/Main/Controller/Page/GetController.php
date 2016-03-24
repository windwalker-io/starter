<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Controller\Page;

use Main\View\Page\PageHtmlView;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\View\PhpHtmlView;
use Windwalker\Utilities\Queue\Priority;
use Windwalker\Renderer\BladeRenderer;
use Windwalker\Renderer\PhpRenderer;
use Windwalker\Renderer\TwigRenderer;

/**
 * Class Get
 *
 * @since 1.0
 */
class GetController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed  Result.
	 *
	 * @since   1.0
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	protected function doExecute()
	{
		$view = $this->getView();

		return $view->setLayout('index')->render();
	}
}

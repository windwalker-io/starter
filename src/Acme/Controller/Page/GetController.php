<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Acme\Controller\Page;

use Acme\View\Page\PageHtmlView;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\View\HtmlView;
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
		$renderer = new PhpRenderer(Priority::createQueue(WINDWALKER_TEMPLATES . '/acme/page'));

		// Using Blade
		// $renderer = new BladeRenderer(Priority::createQueue(WINDWALKER_TEMPLATES . '/acme/page'), array('cache_path' => WINDWALKER_CACHE . '/view'));

		// Using Twig
		// $renderer = new TwigRenderer(Priority::createQueue(WINDWALKER_TEMPLATES . '/acme/page'));

		$view = new PageHtmlView(array(), $renderer);

		return $view->setLayout('index')->render();

		// $view = new HtmlView;

		// $view->setConfig($this->config);

		// return $view->setLayout('index')->render();
	}
}
 
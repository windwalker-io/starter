<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Acme\Controller\Page;

use Acme\View\Page\PageHtmlView;
use Windwalker\Core\Controller\Controller;
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
	 * @return  boolean  True if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 *
	 * @since   1.0
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$renderer = new PhpRenderer(Priority::createQueue(WINDWALKER_TEMPLATES . '/acme/page'));

		// Using Blade
		// $renderer = new BladeRenderer(Priority::createQueue(WINDWALKER_TEMPLATE . '/acme/page'), array('cache_path' => WINDWALKER_CACHE . '/view'));

		// Using Twig
		// $renderer = new TwigRenderer(Priority::createQueue(WINDWALKER_TEMPLATE . '/acme/page'));

		$view = new PageHtmlView(array(), $renderer);

		return $view->setLayout('index')->render();
	}
}
 
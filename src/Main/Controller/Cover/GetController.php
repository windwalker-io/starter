<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Controller\Cover;

use Main\Repository\CoverRepository;
use Main\View\Cover\CoverHtmlView;
use Windwalker\Core\Controller\AbstractController;

/**
 * Class Get
 *
 * @since 2.0
 */
class GetController extends AbstractController
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
	public function doExecute()
	{
		/** @var CoverRepository $repo */
		$repo = $this->getRepository();

		/** @var CoverHtmlView $view */
		$view = $this->getView();

		$view->setRepository($repo, true);

		return $view->render();
	}
}

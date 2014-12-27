<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Acme\Controller\Cover;

use Acme\Model\CoverModel;
use Acme\View\Cover\CoverHtmlView;
use Windwalker\Core\Controller\Controller;

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
	public function doExecute()
	{
		$model = new CoverModel;

		$content = $model->getContent();

		$view = new CoverHtmlView;

		return $view->set('content', $content)->render();
	}
}
 
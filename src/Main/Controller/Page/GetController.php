<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Controller\Page;

use Windwalker\Core\Controller\AbstractController;

/**
 * Class Get
 *
 * @since 1.0
 */
class GetController extends AbstractController
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

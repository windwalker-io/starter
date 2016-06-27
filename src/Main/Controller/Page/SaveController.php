<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Main\Controller\Page;

use Windwalker\Core\Controller\AbstractController;

/**
 * The SaveController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractController
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		return $this->app->uri->current;
	}
}

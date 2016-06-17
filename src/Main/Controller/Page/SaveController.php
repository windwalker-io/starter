<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Main\Controller\Page;

use Windwalker\Core\Controller\AbstractController;
use Windwalker\Core\Controller\Middleware\ErrorHandlingMiddleware;
use Windwalker\Core\Controller\Middleware\RedirectResponseMiddleware;
use Windwalker\Core\Controller\Traits\RedirectResponseTrait;

/**
 * The SaveController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractController
{
	protected $middlewares = [
		RedirectResponseMiddleware::class
	];

	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		return $this->app->uri->current;
	}

	/**
	 * handleFailure
	 *
	 * @param mixed  $data
	 * @param string $message
	 * @param string $type
	 *
	 * @return  boolean
	 */
	public function processFailure($data = null, $message = null, $type = 'warning')
	{
		$this->addMessage($message);

		$this->setRedirect($this->app->uri->current);
	}
}

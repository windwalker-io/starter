<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Controller\Page;

use Windwalker\Core\Controller\AbstractController;
use Windwalker\Core\Controller\Middleware\JsonFormatMiddleware;
use Windwalker\Core\Controller\Traits\HtmlResponseTrait;
use Windwalker\Core\Controller\Traits\JsonResponseTrait;
use Windwalker\Core\Model\Exception\ValidateFailException;
use Windwalker\Core\Utilities\Debug\BacktraceHelper;

/**
 * Class Get
 *
 * @since 1.0
 */
class GetController extends AbstractController
{
	use HtmlResponseTrait;

	protected $middlewares = [
//		JsonFormatMiddleware::class
	];
	
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

		return $view->setLayout('index');
	}
}

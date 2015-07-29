<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\User\Controller\Register;

use Windwalker\Core\Controller\Controller;
use Windwalker\User\Model\LoginModel;
use Windwalker\User\Model\RegistrationModel;
use Windwalker\User\View\Registration\RegistrationHtmlView;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function doExecute()
	{
		$model = new RegistrationModel;

		$view = new RegistrationHtmlView;

		$view['form'] = $model->getForm();

		return $view->render();
	}
}
 
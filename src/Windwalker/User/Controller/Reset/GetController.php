<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\User\Controller\Reset;

use Windwalker\Core\Controller\Controller;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$token = $this->input->get('token');

		$view = $this->getView();
		$model = $this->getModel('Forgot');

		$view['token'] = $token;
		$view['form'] = $model->getForm();
		$view['form']->bind(array('token' => $token));

		return $view->render();
	}
}

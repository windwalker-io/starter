<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Controller\Login;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Ioc;
use Windwalker\User\Model\LoginModel;
use Windwalker\User\View\Login\LoginHtmlView;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LoginController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$model = new LoginModel;

		$user = $this->input->getVar('user');

		$result = $model->login($user['username'], $user['password']);

		if ($result)
		{
			echo 'Success';
		}
		else
		{
			echo 'Fail';
		}

		Ioc::getSession();

		show($_SESSION);
	}
}
 
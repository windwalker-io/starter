<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Controller\Logout;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\User\Model\LoginModel;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
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
		$model = new LoginModel;
		$router = $this->package->getRouter();

		$user = User::get();

		if ($user->isNull())
		{
			$this->setRedirect($router->buildHttp('login', array(), Router::TYPE_FULL), 'Already logout', 'success');
		}

		$model->logout($user->username);

		$this->setRedirect($router->buildHttp('login', array(), Router::TYPE_FULL), 'Logout success', 'success');

		return true;
	}
}
 
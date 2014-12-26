<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Controller\Login;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Language\Language;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\IO\Input;
use Windwalker\Ioc;
use Windwalker\Uri\Uri;
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
	public function doExecute()
	{
		$model = new LoginModel;

		$user = $this->input->getVar('user');

		$result = $model->login($user['username'], $user['password']);

		$package = $this->getPackage();

		if ($result)
		{
			$url = $package->get('redirect.login');

			$msg = Language::translate('pkg.user.login.success');
		}
		else
		{
			$router = $this->package->getRouter();

			$url = $router->buildHttp('login', array(), RestfulRouter::TYPE_FULL);

			$msg = Language::translate('pkg.user.login.fail');
		}

		$uri = new Uri($url);

		if (!$uri->getScheme())
		{
			$url = $this->app->get('uri.base.full') . $url;
		}

		$this->setRedirect($url, $msg);

		return true;
	}
}
 
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\User\Controller\Forgot;

use Windwalker\Core\Authentication\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Language\Translator;
use Windwalker\Core\Router\Router;
use Windwalker\Crypt\CryptHelper;
use Windwalker\Crypt\Password;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$email = $this->input->getEmail('email');

		if (!$email)
		{
			$this->setRedirect($this->router->html('forgot'), Translator::translate('windwalker.user.no.email'));

			return false;
		}

		$view = $this->getView();

		$token = md5($this->app->get('secret') . uniqid() . CryptHelper::genRandomBytes());
		$link  = $this->router->html('reset', array('token' => $token), Router::TYPE_FULL);

		$user = User::get(array('email' => $email));

		if ($user->notNull())
		{
			$password = new Password;

			$user->token = $password->create($token);

			User::save($user);
		}

		$view['user']  = $user;
		$view['token'] = $token;
		$view['link']  = $link;

		$body = $view->setLayout('email')->render();

		// Please send email here.
		// ----------------------------------------------------

		// ----------------------------------------------------

		$this->setRedirect($this->router->html('reset'), array('This is test message.', $body));

		return true;
	}
}

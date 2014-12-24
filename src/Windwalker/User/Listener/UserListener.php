<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Listener;

use Windwalker\Core\Ioc;
use Windwalker\Event\Event;
use Windwalker\Filesystem\Folder;

/**
 * The UserListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserListener
{
	/**
	 * onUserAfterLogin
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onUserAfterLogin(Event $event)
	{
		$options = $event['options'];

		$remember = $options['remember'];

		if ($remember)
		{
			$session = Ioc::getSession();

			setcookie(session_name(), $_COOKIE[session_name()], time() + 60 * 60 * 24 * 100, $session->getOption('cookie_path'), $session->getOption('cookie_domain'));
		}
	}

	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
	}
}

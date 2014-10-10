<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Listener;

use Windwalker\Event\Event;

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
		show($event);
	}

	public function onAfterInitialise(Event $event)
	{
	}
}

<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\User\User\UserHandler;

/**
 * The UserPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserPackage extends AbstractPackage
{
	protected $name = 'user';

	public function initialise()
	{
		parent::initialise();

		User::setHandler(new UserHandler);
	}
}
 
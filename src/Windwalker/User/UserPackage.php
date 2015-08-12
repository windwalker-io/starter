<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\User;

use Windwalker\Core\Authentication\User;
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
 
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\User\Model;

use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Form\Form;

/**
 * The ForgorModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ForgotModel extends DatabaseModel
{
	public function getForm()
	{
		return $this->fetch('login.form', function()
		{
			$form = new Form('user');

			$form->defineFormFields(new LoginFieldDefinition);

			return $form;
		});
	}
}

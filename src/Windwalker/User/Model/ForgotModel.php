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
use Windwalker\User\Form\ForgotFieldDefinition;

/**
 * The ForgorModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ForgotModel extends DatabaseModel
{
	/**
	 * getForm
	 *
	 * @return  Form
	 */
	public function getForm()
	{
		return $this->fetch('forgot.form', function()
		{
			$form = new Form;

			$form->defineFormFields(new ForgotFieldDefinition);

			return $form;
		});
	}
}

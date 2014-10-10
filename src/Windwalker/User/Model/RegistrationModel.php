<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Model;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Model\Model;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\Form\Field\AbstractField;
use Windwalker\Form\Form;
use Windwalker\User\Form\RegistrationFieldDefinition;

/**
 * The RegistrationModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RegistrationModel extends Model
{
	/**
	 * getForm
	 *
	 * @return  Form
	 */
	public function getForm()
	{
		return $this->fetch('login.form', function()
		{
			$form = new Form('registration');

			$form->defineFormFields(new RegistrationFieldDefinition);

			foreach ($form as $field)
			{
				/** @var AbstractField $field */
				$field->set('controlClass', 'form-group');
				$field->set('class', 'form-control col-md-10');
				$field->set('labelClass', 'control-label col-md-2');
			}

			return $form;
		});
	}

	/**
	 * register
	 *
	 * @param array $user
	 *
	 * @throws \Exception
	 * @return  bool
	 */
	public function register($user)
	{
		$user = new Data($user);

		if ($user->password != $user->password2)
		{
			throw new \Exception('Password not match.');
		}

		$password = new Password;

		$user->password = $password->create($user->password);

		unset($user->password2);

		User::save($user);

		return true;
	}
}
 
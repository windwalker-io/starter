<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Model;

use Windwalker\Authenticate\Authenticate;
use Windwalker\Authenticate\Credential;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\Model;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Field\AbstractField;
use Windwalker\Form\Form;
use Windwalker\Ioc;
use Windwalker\User\Form\LoginFieldDefinition;

/**
 * The LoginModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LoginModel extends Model
{
	public function getForm()
	{
		return $this->fetch('login.form', function()
		{
			$form = new Form('user');

			$form->defineFormFields(new LoginFieldDefinition);

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

	public function login($username, $password)
	{
		$credential = new Credential(array('username' => $username, 'password' => $password));

		if (!User::login($credential, true))
		{
			$this['errors'] = User::getResults();

			return false;
		}

		return true;
	}

	public function logout($username)
	{
		$credential = new Credential(array('username' => $username));

		if (User::logout($credential))
		{
			return false;
		}

		return true;
	}
}
 
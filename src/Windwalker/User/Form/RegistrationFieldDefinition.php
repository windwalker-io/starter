<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\Form;

use Faker\Factory;
use Windwalker\Form\Field\EmailField;
use Windwalker\Form\Field\PasswordField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The RegistrationFieldDefainition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RegistrationFieldDefinition implements FieldDefinitionInterface
{
	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 */
	public function define(Form $form)
	{
		$faker = Factory::create();

		$form->addField(new TextField('username'))
			->label('Username')
			//->set('default', $faker->userName)
			->required();

		$form->addField(new TextField('name'))
			->label('Name')
			//->set('default', $faker->name)
			->required();

		$form->addField(new PasswordField('password'))
			->label('Password')
			//->set('default', 1234)
			->required();

		$form->addField(new PasswordField('password2'))
			//->set('default', 1234)
			->label('Valid Password');

		$form->addField(new EmailField('email'))
			->label('Email')
			//->set('default', $faker->email)
			->required();
	}
}

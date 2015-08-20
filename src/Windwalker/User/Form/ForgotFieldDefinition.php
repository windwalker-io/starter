<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\User\Form;

use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The ForgotFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ForgotFieldDefinition implements FieldDefinitionInterface
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
		$form->wrap('forgot', null, function(Form $form)
		{
			$form->add('email', new TextField)
				->label('Email')
				->required();
		});

		$form->wrap('reset', null, function(Form $form)
		{
			$form->add('username', new TextField)
				->label('Username')
				->required();

			$form->add('token', new TextField)
				->label('Token')
				->required();
		});
	}
}

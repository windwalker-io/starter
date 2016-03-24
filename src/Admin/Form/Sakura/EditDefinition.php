<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Form\Sakura;

use Admin\Field\Sakura\SakuraListField;
use Admin\Field\Sakura\SakuraModalField;
use Phoenix;
use Windwalker\Core\Language\Translator;
use Windwalker\Filter\InputFilter;
use Windwalker\Form\Field;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Html\Option;
use Windwalker\Validator\Rule;

/**
 * The SakuraEditDefinition class.
 *
 * @since  1.0
 */
class EditDefinition implements FieldDefinitionInterface
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
		// Basic fieldset
		$form->wrap('basic', null, function(Form $form)
		{
			// ID
			$form->add('id', new Field\HiddenField);

			// Title
			$form->add('title', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.title'))
				->setFilter('trim')
				->required(true);

			// Alias
			$form->add('alias', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.alias'));

			// Image
			$form->add('image', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.image'));

			// URL
			$form->add('url', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.url'))
				->setValidator(new Rule\UrlValidator)
				->set('class', 'validate-url');

			// Example: Sakura List
			$form->add('sakura_list', new SakuraListField)
				->label('List Example');

			// Example: Sakura Modal
			$form->add('sakura_modal', new SakuraModalField)
				->label('Modal Example');
		});

		// Text Fieldset
		$form->wrap('text', null, function(Form $form)
		{
			// Introtext
			$form->add('introtext', new Field\TextareaField)
				->label(Translator::translate('admin.sakura.field.introtext'))
				->set('rows', 10);

			// Fulltext
			$form->add('fulltext', new Field\TextareaField)
				->label(Translator::translate('admin.sakura.field.fulltext'))
				->set('rows', 10);
		});

		// Created fieldset
		$form->wrap('created', null, function(Form $form)
		{
			// State
			$form->add('state', new Field\RadioField)
				->label(Translator::translate('admin.sakura.field.state'))
				->set('class', 'btn-group')
				->set('default', 1)
				->addOption(new Option(Translator::translate('phoenix.grid.state.published'), '1'))
				->addOption(new Option(Translator::translate('phoenix.grid.state.unpublished'), '0'));

			// Created
			$form->add('created', new Phoenix\Field\CalendarField)
				->label(Translator::translate('admin.sakura.field.created'));

			// Modified
			$form->add('modified', new Phoenix\Field\CalendarField)
				->label(Translator::translate('admin.sakura.field.modified'))
				->disabled();

			// Author
			$form->add('created_by', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.author'));

			// Modified User
			$form->add('modified_by', new Field\TextField)
				->label(Translator::translate('admin.sakura.field.modifiedby'))
				->disabled();
		});
	}
}

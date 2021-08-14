<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\SunFlower\Form;

use Unicorn\Field\CalendarField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\NumberField;
use Windwalker\Form\Field\HiddenField;
use Unicorn\Enum\BasicState;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The EditForm class.
 */
class EditForm implements FieldDefinitionInterface
{
    /**
     * Define the form fields.
     *
     * @param  Form  $form  The Windwalker form object.
     *
     * @return  void
     */
    public function define(Form $form): void
    {
        $form->add('title', TextField::class)
            ->label('Title')
            ->addFilter('trim');

        $form->add('alias', TextField::class)
            ->label('Alias')
            ->addFilter('trim');

        $form->fieldset(
            'basic',
            function (Form $form) {
                $form->add('id', HiddenField::class);

                $form->add('category_id', NumberField::class)
                    ->label('Category Id');

                $form->add('state', NumberField::class)
                    ->label('State');

                $form->add('image', TextField::class)
                    ->label('Image');

                $form->add('attachments', TextareaField::class)
                    ->label('Attachments')
                    ->rows(7);

                $form->add('content', TextareaField::class)
                    ->label('Content')
                    ->rows(7);

                $form->add('created', CalendarField::class)
                    ->label('Created');

                $form->add('created_by', NumberField::class)
                    ->label('Created By');

                $form->add('modified', CalendarField::class)
                    ->label('Modified');

                $form->add('modified_by', NumberField::class)
                    ->label('Modified By');

                $form->add('params', TextareaField::class)
                    ->label('Params')
                    ->rows(7);
            }
        );
    }
}

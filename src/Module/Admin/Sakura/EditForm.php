<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use App\Module\Admin\Category\Form\CategoryListField;
use Unicorn\Field\CalendarField;
use Windwalker\Form\Field\TextareaField;
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
            ->label('Title');

        $form->fieldset(
            'basic',
            function (Form $form) {
                $form->add('category_id', CategoryListField::class)
                    ->label('Category');
            }
        );

        $form->fieldset(
            'text',
            function (Form $form) {
                $form->add('content', TextareaField::class)
                    ->label('Content')
                    ->rows(8);
            }
        );

        $form->fieldset(
            'meta',
            function (Form $form) {
                $form->add('created', CalendarField::class)
                    ->label('Created');
            }
        );
    }
}

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
use App\Module\Admin\Sakura\Form\SakuraModalField;
use Unicorn\Field\CalendarField;
use Unicorn\Field\FileDragField;
use Windwalker\Form\Field\HiddenField;
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

                $form->add('parent_id', SakuraModalField::class)
                    ->label('Parent')
                    ->set('floating', false)
                    ->multiple(true)
                    ->sortable(true)
                    ->max(3);

                $form->add('file', FileDragField::class)
                    ->label('File')
                    ->set('floating', false)
                    ->multiple(true)
                    ->height(300)
                    ->maxFiles(3)
                    ->maxSize(1)
                    ->accept('.pdf');

                $form->add('id', HiddenField::class);
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
                    ->label('Created')
                    ->set('floating', false);
            }
        );
    }
}

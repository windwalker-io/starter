<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Sakura;

use Windwalker\Form\Field\TextField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\NumberField;
use Unicorn\Field\CalendarField;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The EditForm class.
 */
class TestForm implements FieldDefinitionInterface
{
    /**
     * Define the form fields.
     *
     * @param    Form  $form  The Windwalker form object.
     *
     * @return    void
     */
    public function define(Form $form): void
    {
        // @test

        $form->fieldset(
            'basic',
            function (Form $form) {
                $form->add('id', HiddenField::class)
                    ->label('fff');

                $form->add('title', CalendarField::class)->label('Title');
            }
        );
        $form->add('category_id', NumberField::class)
            ->label('CategoryId');

        $form->add('state', NumberField::class)
            ->label('State');

        $form->add('content', TextareaField::class)
            ->label('Content')
            ->rows(7);

        $form->add('ordering', NumberField::class)
            ->label('Ordering');

        $form->add('created', CalendarField::class)
            ->label('Created');

        $form->add('parent_id', TextField::class)
            ->label('ParentId');
    }
}

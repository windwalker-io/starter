<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use App\Enum\State;
use Windwalker\Form\Attributes\Fieldset;
use Windwalker\Form\Attributes\NS;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The GridForm class.
 */
class GridForm implements FieldDefinitionInterface
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
        $form->register(
            #[NS('search')]
            function (Form $form) {
                $form->add('fields', ListField::class)
                    ->option('', 'category.title')
                    ->option('', 'category.alias');

                $form->add('content', TextField::class)
                    ->addFilter('trim');
            }
        );

        $form->register(
            #[NS('filter')]
            function (Form $form) {
                $form->add('state', ListField::class)
                    ->option('- Select State-', '')
                    ->option('Published', (string) State::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) State::UNPUBLISHED()->getValue())
                    ->attr('x-on:change', 'grid().sendFilter()');
            }
        );
    }
}

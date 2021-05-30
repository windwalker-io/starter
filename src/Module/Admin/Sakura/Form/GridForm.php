<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura\Form;

use App\Enum\State;
use App\Module\Admin\Category\Form\CategoryListField;
use Windwalker\Form\Attributes\NS;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\SearchField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Utilities\Symbol;

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
        $form->ns(
            'search',
            function (Form $form) {
                $form->add('*', SearchField::class)
                    ->addFilter('trim')
                    ->attr('x-on:keydown.enter', '$store.grid.sendFilter($event)');
            }
        );

        $form->ns(
            'filter',
            function (Form $form) {
                $form->add('sakura.state', ListField::class)
                    ->label('State')
                    ->option('- Select -', '')
                    ->option('Published', (string) State::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) State::UNPUBLISHED()->getValue())
                    ->attr('x-on:change', '$store.grid.sendFilter()');
            }
        );

        $form->ns(
            'batch',
            function (Form $form) {
                $form->add('state', ListField::class)
                    ->label('State')
                    ->option('No change', '')
                    ->option('Make empty', Symbol::empty()->getValue())
                    ->option('Published', (string) State::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) State::UNPUBLISHED()->getValue());

                $form->add('category_id', CategoryListField::class)
                    ->label('Category')
                    ->option('No change', '');
            }
        );
    }
}

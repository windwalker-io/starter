<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category\Form;

use App\Enum\State;
use Windwalker\Form\Attributes\NS;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\SearchField;
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
                $form->add('*', SearchField::class)
                    ->addFilter('trim')
                    ->attr('x-on:keydown.enter', '$store.grid.sendFilter($event)');
            }
        );

        $form->register(
            #[NS('filter')]
            function (Form $form) {
                $form->add('state', ListField::class)
                    ->option('- Select State-', '')
                    ->option('Published', (string) State::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) State::UNPUBLISHED()->getValue())
                    ->attr('x-on:change', '$store.grid.sendFilter()');
            }
        );
    }
}

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\SunFlower\Form;

use Unicorn\Enum\BasicState;
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
        $form->ns(
            'search',
            function (Form $form) {
                $form->add('*', SearchField::class)
                    ->placeholder('Search')
                    ->attr('x-on:keydown.enter', '$store.grid.sendFilter($event)');
            }
        );

        $form->ns(
            'filter',
            function (Form $form) {
                $form->add('sun_flower.state', ListField::class)
                    ->label('State')
                    ->option('- Select -', '')
                    ->option('Published', (string) BasicState::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) BasicState::UNPUBLISHED()->getValue())
                    ->attr('x-on:change', '$store.grid.sendFilter()');
            }
        );

        $form->ns(
            'batch',
            function (Form $form) {
                $form->add('state', ListField::class)
                    ->label('State')
                    ->option('- No change -', '')
                    ->option('Published', (string) BasicState::PUBLISHED()->getValue())
                    ->option('Unpublished', (string) BasicState::UNPUBLISHED()->getValue());
            }
        );
    }
}

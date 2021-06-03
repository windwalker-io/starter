<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Hello\Form;

use Windwalker\Form\Field\HiddenField;
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
     * @param    Form  $form  The Windwalker form object.
     *
     * @return    void
     */
    public function define(Form $form): void
    {
        $form->fieldset(
            'basic',
            function (Form $form) {
                $form->add('id', HiddenField::class);
            }
        );
    }
}

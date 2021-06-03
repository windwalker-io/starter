<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Hello;

use Windwalker\DOM\DOMElement;
use Windwalker\Form\Field\AbstractField;

/**
 * The HelloListField class.
 */
class HelloListField extends AbstractField
{
    /**
     * prepareInput
     *
     * @param    DOMElement  $input
     *
     * @return    DOMElement
     */
    public function prepareInput(DOMElement $input): DOMElement
    {
        return $input;
    }

    /**
     * getAccessors
     *
     * @return    array
     */
    protected function getAccessors(): array
    {
        return array_merge(
            parent::getAccessors(),
            []
        );
    }
}

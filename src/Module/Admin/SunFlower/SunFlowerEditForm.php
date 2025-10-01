<?php

declare(strict_types=1);

namespace App\Module\Admin\SunFlower;

use Unicorn\Field\CalendarField;
use Windwalker\Form\Field\TextareaField;
use Unicorn\Field\SwitcherField;
use Windwalker\Form\Field\NumberField;
use Windwalker\Core\Language\TranslatorTrait;
use Windwalker\Form\Attributes\Fieldset;
use Windwalker\Form\Attributes\FormDefine;
use Windwalker\Form\Attributes\NS;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\Form;

class SunFlowerEditForm
{
    use TranslatorTrait;

    #[FormDefine]
    #[NS('item')]
    public function main(Form $form): void
    {
        $form->add('title', TextField::class)
            ->label($this->trans('unicorn.field.title'))
            ->addFilter('trim')
            ->addValidator('int')
            ->required(true);

        $form->add('alias', TextField::class)
            ->label($this->trans('unicorn.field.alias'))
            ->addFilter('trim');

        $form->add('id', HiddenField::class);
    }

    #[FormDefine]
    #[Fieldset('basic')]
    #[NS('item')]
    public function basic(Form $form): void
    {
        //
        $form->add('category_id', NumberField::class)
            ->label('Category Id');

        $form->add('state', SwitcherField::class)
            ->label($this->trans('unicorn.field.published'))
            ->circle(true)
            ->color('success')
            ->defaultValue('1');

        $form->add('image', TextField::class)
            ->label($this->trans('unicorn.field.image'));

        $form->add('ordering', NumberField::class)
            ->label($this->trans('unicorn.field.ordering'));

        $form->add('content', TextareaField::class)
            ->label('Content')
            ->rows(7);

        $form->add('created', CalendarField::class)
            ->label($this->trans('unicorn.field.created'));

        $form->add('created_by', NumberField::class)
            ->label($this->trans('unicorn.field.author'));

        $form->add('modified', CalendarField::class)
            ->label($this->trans('unicorn.field.modified'));

        $form->add('modified_by', NumberField::class)
            ->label($this->trans('unicorn.field.modified_by'));
    }
}

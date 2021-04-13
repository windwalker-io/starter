<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use Windwalker\Core\Language\LangService;
use Windwalker\Form\Attributes\Fieldset;
use Windwalker\Form\Field\CheckboxField;
use Windwalker\Form\Field\DatetimeLocalField;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The Editform class.
 */
class EditForm implements FieldDefinitionInterface
{
    /**
     * EditForm constructor.
     *
     * @param  LangService  $lang
     * @param  array        $options
     */
    public function __construct(protected LangService $lang, protected array $options = [])
    {
    }

    /**
     * Define the form fields.
     *
     * @param  Form  $form  The Windwalker form object.
     *
     * @return  void
     */
    public function define(Form $form): void
    {
        $lang = $this->lang->extract('luna.');

        // Title
        $form->add('title', TextField::class)
            ->label($lang('category.field.title'))
            ->placeholder($lang('category.field.title'))
            ->addFilter('trim')
            ->required(true);

        // Alias
        $form->add('alias', TextField::class)
            ->label($lang('category.field.alias'))
            ->placeholder($lang('category.field.alias'));

        // Basic fieldset
        $form->register(
            #[Fieldset('basic', 'Basic')]
            function (Form $form) use ($lang) {
                $type = $this->options['type'] ?? '';

                // ID
                $form->add('id', HiddenField::class);

                // Parent
                // $form->categoryList('parent_id')
                //     ->label($lang('category.field.parent'))
                //     ->class('has-select2')
                //     ->option($lang('category.root'), 1)
                //     ->categoryType($type)
                //     ->postQueryHandler(function (Query $query) {
                //         $input = Ioc::getInput();
                //
                //         if ($id = $input->get('id')) {
                //             $self = CategoryMapper::findOne($id);
                //
                //             $query->where('(lft < ' . $self->lft . ' OR rgt > ' . $self->rgt . ')');
                //         }
                //     });

                // Images
                // $this->singleImageDrag('image')
                //     ->label($lang('category.field.images'))
                //     ->version(2)
                //     ->exportZoom(2)
                //     ->showSizeNotice(true)
                //     ->width(400)
                //     ->height(300);

                $form->add('type', HiddenField::class)
                    ->label($lang('category.field.type'));
            }
        );

        // Text Fieldset
        $form->fieldset(
            'text',
            function (Form $form) use ($lang) {
                // Description
                $form->add('description', TextareaField::class)
                    ->label($lang('category.field.description'))
                    // ->editorOptions(
                    //     [
                    //         'height' => 450,
                    //     ]
                    // )
                    ->rows(10);
            }
        );

        // Created fieldset
        $form->register(
            #[Fieldset('register', 'Register')]
            function (Form $form) use ($lang) {
                // State
                $form->add('state', CheckboxField::class)
                    ->label($lang('category.field.published'))
                    ->addClass('')
                    // ->circle(true)
                    // ->color('success')
                    ->defaultValue(1);

                // if (Locale::isEnabled()) {
                //     // Language
                //     $this->languageList('language')
                //         ->label($lang('category.field.language'))
                //         ->option($lang('field.language.all'), '*');
                // }

                // Created
                $form->add('created', DatetimeLocalField::class)
                    ->label($lang('category.field.created'))
                    // ->addFilter()
                ;

                // Modified
                $form->add('modified', DatetimeLocalField::class)
                    ->label($lang('category.field.modified'))
                    ->disabled(true);

                // if (WarderHelper::tableExists('users')) {
                //     // Author
                //     $this->userModal('created_by')
                //         ->label($lang('category.field.author'));
                //
                //     // Modified User
                //     $this->userModal('modified_by')
                //         ->label($lang('category.field.modifiedby'))
                //         ->disabled();
                // }
            }
        );
    }
}

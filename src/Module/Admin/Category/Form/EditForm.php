<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category\Form;

use App\Entity\Category;
use App\Module\Admin\Category\CategoryStateWorkflow;
use Unicorn\Field\CalendarField;
use Unicorn\Field\InlineField;
use Unicorn\Field\StateListField;
use Unicorn\Field\SwitcherField;
use Windwalker\Core\Http\AppRequest;
use Windwalker\Core\Language\LangService;
use Windwalker\Data\Collection;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\Form\Attributes\Fieldset;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\NumberField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\Field\UrlField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\ORM\SelectorQuery;
use Windwalker\Query\Query;

use function Windwalker\now;

/**
 * The Editform class.
 */
class EditForm implements FieldDefinitionInterface
{
    /**
     * EditForm constructor.
     *
     * @param  LangService  $lang
     * @param  AppRequest   $request
     * @param  array        $options
     */
    public function __construct(
        protected LangService $lang,
        protected AppRequest $request,
        #[Autowire] protected CategoryStateWorkflow $categoryStateWorkflow,
        protected array $options = []
    ) {
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
            ->placeholder($lang('category.field.alias'))
            ->description('Alias Description');

        // Basic fieldset
        $form->register(
            #[Fieldset('basic', 'Basic')]
            function (
                Form $form
            ) use ($lang) {
                $type = $this->options['type'] ?? '';

                $form->add('url', UrlField::class)
                    ->label('URL')
                    ->placeholder('URL');

                // ID
                $form->add('id', HiddenField::class);

                // Parent
                $form->add('parent_id', CategoryListField::class)
                    ->label($lang('category.field.parent'))
                    ->option($lang('category.root'), '1')
                    // ->categoryType($type)
                    ->configureQuery(
                        function (SelectorQuery $query) {
                            if ($id = $this->request->input('id')) {
                                if ($self = $query->getORM()->findOne(Category::class, $id)) {
                                    $query->orWhere(
                                        function (Query $query) use ($self) {
                                            $query->where('lft', '<', $self->getLft());
                                            $query->where('rgt', '>', $self->getRgt());
                                        }
                                    );
                                }
                            }
                        }
                    );

                $form->ns('foo', function (Form $form) {

                });

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
            #[Fieldset('meta')]
            function (
                Form $form
            ) use ($lang) {
                // State
                $form->add('state', StateListField::class)
                    ->label($lang('category.field.state'))
                    ->workflow($this->categoryStateWorkflow);

                // if (Locale::isEnabled()) {
                //     // Language
                //     $this->languageList('language')
                //         ->label($lang('category.field.language'))
                //         ->option($lang('field.language.all'), '*');
                // }

                // Created
                $form->add('created', CalendarField::class)
                    ->label($lang('category.field.created'))
                    ->enableTime(true)
                    ->calendarOptions([])// ->addFilter()
                ;

                // Modified
                $form->add('modified', CalendarField::class)
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

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
use Unicorn\Field\SqlListField;
use Windwalker\Core\Language\LangService;
use Windwalker\DI\Attributes\Inject;
use Windwalker\Query\Query;

/**
 * The CategoryListField class.
 *
 * @method  $this  categoryType(string $value = null)
 * @method  string  getCategoryType()
 * @method  $this  showRoot(string $value = null)
 * @method  string  getShowRoot()
 * @method  $this  maxLevel(int $value = null)
 * @method  int  getMaxLevel()
 * @method  $this  minLevel(int $value = null)
 * @method  int  getMinLevel()
 */
class CategoryListField extends SqlListField
{
    #[Inject]
    protected LangService $lang;

    protected ?string $table = Category::class;

    protected function prepareQuery(Query $query): void
    {
        $query->where('parent_id', '!=', '0');

        if ($this->getMaxLevel()) {
            $query->where('level', '<=', $this->getMaxLevel());
        }

        if ($this->getMinLevel()) {
            $query->where('level', '>=', $this->getMinLevel());
        }
    }

    protected function prepareOptions(): array
    {
        $options = parent::prepareOptions();

        if ($id = $this->getShowRoot()) {
            if (!is_numeric($id)) {
                $id = '1';
            }

            array_unshift(
                $options,
                static::createOption($this->lang->trans('luna.category.root'), $id)
            );
        }

        return $options;
    }

    /**
     * getAccessors
     *
     * @return  array
     */
    protected function getAccessors(): array
    {
        return array_merge(
            parent::getAccessors(),
            [
                'categoryType',
                'showRoot',
                'maxLevel',
                'minLevel',
            ]
        );
    }
}

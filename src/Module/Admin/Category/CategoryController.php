<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use App\Entity\Category;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\TaskMapping;
use Windwalker\Core\Form\Exception\ValidateFailException;
use Windwalker\Core\Module\ModuleInterface;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\RouteUri;
use Windwalker\Core\State\AppState;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\Event\BeforeSaveEvent;
use Windwalker\ORM\ORM;
use Windwalker\Session\Session;

/**
 * The CategoryController class.
 */
#[Controller(
    module: CategoryModule::class
)]
#[TaskMapping(
    methods: [
        'PUT' => 'filter',
    ]
)]
class CategoryController
{
    public function filter(AppState $state, Navigator $nav): RouteUri
    {
        $state->rememberFromRequest('filter');
        $state->rememberFromRequest('search');
        $state->rememberFromRequest('page');
        $state->rememberFromRequest('limit');
        $state->rememberFromRequest('list_ordering');

        return $nav->self();
    }

    public function save(
        AppContext $app,
        AppState $state,
        Navigator $nav,
        #[Autowire] CategoryRepository $repository,
        ORM $orm
    ): RouteUri {
        try {
            $item = $app->input('item');

            /** @var Category $item */
            $item = $repository->createSaveAction()
                ->processDataAndSave($item);

            return $nav->self()->id($item->getId());
        } catch (\RuntimeException $e) {
            $item = $app->input('item');
            $state->remember('edit.data', $item);

            return $nav->self()
                ->id($item['id'] ?? null)
                ->withMessage($e->getMessage(), 'warning');
        }
    }
}

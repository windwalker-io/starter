<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use App\Module\Admin\Category\CategoryEditView;
use App\Module\Admin\Category\CategoryListView;
use App\Module\Admin\Category\CategoryController;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('category')
    ->register(function (RouteCreator $router) {
        $router->any('category_list', '/categories')
            ->controller(CategoryController::class)
            ->view(CategoryListView::class);

        $router->any('category_edit', '/category/edit[/{id}]')
            ->controller(CategoryController::class)
            ->view(CategoryEditView::class);
    });

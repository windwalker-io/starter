<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Routes;

use App\Module\Admin\Category\CategoriesView;
use App\Module\Admin\Category\CategoryController;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('category')
    ->register(function (RouteCreator $router) {
        $router->any('categories', 'categories')
            ->controller(CategoryController::class)
            ->view(CategoriesView::class);
    });

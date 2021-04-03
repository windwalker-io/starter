<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Category;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\TaskMapping;
use Windwalker\Core\Router\Navigator;
use Windwalker\Session\Session;

/**
 * The CategoryController class.
 */
#[Controller(

)]
#[TaskMapping(
    methods: [
        'PATCH' => 'filter'
    ]
)]
class CategoryController
{
    public function filter(AppContext $app, Session $session, Navigator $nav)
    {
        $session->overrideWith('categories.filter', $app->input('filter'));
        $session->overrideWith('categories.search', $app->input('search'));
        $session->overrideWith('categories.page', $app->input('page'));
        $session->overrideWith('categories.limit', $app->input('limit'));
        $session->overrideWith('categories.list_order', $app->input('list_order'));
        $session->overrideWith('categories.list_dir', $app->input('list_dir'));

        $route = $app->getMatchedRoute();

        return $nav->to($route->getName());
    }
}

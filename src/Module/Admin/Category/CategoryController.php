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
        'PUT' => 'filter'
    ]
)]
class CategoryController
{
    public function filter(AppContext $app, Session $session, Navigator $nav)
    {
        $state = $app->getSubState('category');

        $state->persistFromRequest('filter');
        $state->persistFromRequest('search');
        $state->persistFromRequest('page');
        $state->persistFromRequest('limit');
        $state->persistFromRequest('list_ordering');

        $route = $app->getMatchedRoute();

        return $nav->to($route->getName());
    }
}

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\TaskMapping;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\RouteUri;
use Windwalker\DI\Attributes\Autowire;

/**
 * The SakuraController class.
 */
#[Controller(
    module: SakuraModule::class
)]
#[TaskMapping(
    methods: [
        'PUT' => 'filter',
        'DELETE' => 'deleteList',
        'PATCH' => 'batch'
    ]
)]
class SakuraController
{
    public function batch(AppContext $app)
    {
        $task = $app->input('task');

        return $app->call([$this, 'batch' . ucfirst($task)]);
    }

    public function batchMove(AppContext $app, #[Autowire] SakuraRepository $repository, Navigator $nav): RouteUri
    {
        $ids = (array) $app->input('id');

        $repository->createReorderAction()->move($ids, (int) $app->input('delta'));

        return $nav->back();
    }

    public function batchReorder(AppContext $app, #[Autowire] SakuraRepository $repository, Navigator $nav): RouteUri
    {
        $orders = (array) $app->input('ordering');

        $repository->createReorderAction()->reorder($orders);

        return $nav->back();
    }
}

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use Unicorn\Controller\CrudController;
use Unicorn\Controller\GridController;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\DI\Attributes\Autowire;

use function Windwalker\pipe;
use function Windwalker\tap;

/**
 * The SakuraController class.
 */
#[Controller(
    module: SakuraModule::class
)]
// #[TaskMapping(
//     methods: [
//         'PUT' => 'filter',
//         'DELETE' => 'deleteList',
//         'PATCH' => 'batch',
//         'POST' => 'batchCopy',
//     ]
// )]
class SakuraController
{
    public function save(AppContext $app, #[Autowire] SakuraRepository $repository, #[Autowire] EditForm $form, CrudController $controller): mixed
    {
        return $app->call([$controller, 'save'], compact('repository', 'form'));
    }

    public function delete(AppContext $app, #[Autowire] SakuraRepository $repository, CrudController $controller): mixed
    {
        return $app->call([$controller, 'delete'], compact('repository'));
    }

    public function filter(AppContext $app, #[Autowire] SakuraRepository $repository, GridController $controller): mixed
    {
        return $app->call([$controller, 'filter'], compact('repository'));
    }

    public function batch(AppContext $app, #[Autowire] SakuraRepository $repository, GridController $controller): mixed
    {
        $task = $app->input('task');
        $data = match ($task) {
            'publish' => ['state' => 1],
            'unpublish' => ['state' => 0],
            'archive' => ['state' => -1],
            'trash' => ['state' => -2],
            default => null
        };

        return $app->call([$controller, 'batch'], compact('repository', 'data'));
    }

    public function copy(AppContext $app, #[Autowire] SakuraRepository $repository, GridController $controller): mixed
    {
        return $app->call([$controller, 'copy'], compact('repository'));
    }
}

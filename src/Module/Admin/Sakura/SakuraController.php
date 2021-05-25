<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use Unicorn\Controller\GridControllerTrait;
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
    use GridControllerTrait;


}

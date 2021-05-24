<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\TaskMapping;

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
    //
}

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Sakura;

use Unicorn\Controller\BatchControllerTrait;
use Unicorn\Controller\CrudControllerTrait;
use Unicorn\Controller\GridControllerTrait;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\TaskMapping;

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
    use GridControllerTrait;
    use BatchControllerTrait;
    use CrudControllerTrait;

    public function getRepositoryClass(): string
    {
        return SakuraRepository::class;
    }

    public function getEditForm(): string
    {
        return EditForm::class;
    }
}

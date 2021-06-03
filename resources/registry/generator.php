<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'controller' => \Windwalker\Core\Generator\Command\ControllerSubCommand::class,
    'view' => \Windwalker\Core\Generator\Command\ViewSubCommand::class,
    'model' => \Windwalker\Core\Generator\Command\ModelSubCommand::class,
    'form' => \Windwalker\Core\Generator\Command\FormSubCommand::class,
    'route' => \Windwalker\Core\Generator\Command\RouteSubCommand::class,
    'enum' => \Windwalker\Core\Generator\Command\EnumSubCommand::class,
    'field' => \Windwalker\Core\Generator\Command\FieldSubCommand::class
];

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'controller' => \Windwalker\Core\Generator\SubCommand\ControllerSubCommand::class,
    'view' => \Windwalker\Core\Generator\SubCommand\ViewSubCommand::class,
    'model' => \Windwalker\Core\Generator\SubCommand\ModelSubCommand::class,
    'form' => \Windwalker\Core\Generator\SubCommand\FormSubCommand::class,
    'route' => \Windwalker\Core\Generator\SubCommand\RouteSubCommand::class,
    'enum' => \Windwalker\Core\Generator\SubCommand\EnumSubCommand::class,
    'field' => \Windwalker\Core\Generator\SubCommand\FieldSubCommand::class
];

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\Ref;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Console\CoreCommand;
use Windwalker\DI\Attributes\AttributeType;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\DI\Attributes\Decorator;
use Windwalker\DI\Attributes\Inject;
use Windwalker\Utilities\Arr;

use function Windwalker\include_files;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => include_files(__DIR__ . '/di/*.php'),
        'providers' => [

        ],
        'binding' => [

        ],
        'aliases' => [

        ],
        'attributes' => [
            // Declaration
            Decorator::class => AttributeType::CLASSES,
            Autowire::class => AttributeType::CLASSES | AttributeType::CALLABLE | AttributeType::PARAMETERS,
            Inject::class => AttributeType::PROPERTIES,
            Ref::class => AttributeType::PARAMETERS,

            // Decorators
            Controller::class => AttributeType::CLASSES,
            ViewModel::class => AttributeType::CLASSES,
            CoreCommand::class => AttributeType::CLASSES | AttributeType::CALLABLE,
        ]
    ]
);

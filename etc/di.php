<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Console\CommandWrapper;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\Csrf;
use Windwalker\Core\Attributes\Json;
use Windwalker\Core\Attributes\JsonApi;
use Windwalker\Core\Attributes\Module;
use Windwalker\Core\Attributes\Ref;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\DI\Attributes\AttributeType;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\DI\Attributes\Decorator;
use Windwalker\DI\Attributes\Inject;
use Windwalker\DI\Attributes\Service;
use Windwalker\DI\Attributes\Setup;
use Windwalker\Utilities\Arr;

use function Windwalker\include_arrays;

return Arr::mergeRecursive(
    // Load with namespace,
    [
        'factories' => include_arrays(__DIR__ . '/di/*.php'),
        'providers' => [

        ],
        'binding' => [

        ],
        'aliases' => [

        ],
        'layouts' => [
            //
        ],
        'attributes' => [
            // Declaration
            Decorator::class => AttributeType::CLASSES,
            Autowire::class => AttributeType::CLASSES | AttributeType::CALLABLE | AttributeType::PARAMETERS,
            Inject::class => AttributeType::PROPERTIES | AttributeType::PARAMETERS,
            Setup::class => AttributeType::METHODS,
            Service::class => AttributeType::PROPERTIES | AttributeType::PARAMETERS,
            Ref::class => AttributeType::PARAMETERS,

            // Decorators
            Module::class => AttributeType::CLASSES,
            Controller::class => AttributeType::CLASSES,
            ViewModel::class => AttributeType::CLASSES,
            CommandWrapper::class => AttributeType::CLASSES | AttributeType::CALLABLE,

            // Middleware
            Csrf::class => AttributeType::CALLABLE,
            Json::class => AttributeType::CALLABLE,
            JsonApi::class => AttributeType::CALLABLE,
        ]
    ]
);

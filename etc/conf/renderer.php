<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Edge\Component\XComponent;
use Windwalker\Core\Edge\EdgeProvider;
use Windwalker\Core\Form\FormProvider;
use Windwalker\Core\Provider\RendererProvider;
use Windwalker\Core\Theme\BootstrapTheme;
use Windwalker\Core\Theme\ThemeInterface;
use Windwalker\DI\Container;
use Windwalker\Renderer\EdgeRenderer;
use Windwalker\Renderer\MustacheRenderer;
use Windwalker\Renderer\PlatesRenderer;
use Windwalker\Renderer\TwigRenderer;

return [
    'paths' => [
        __DIR__ . '/../../views'
    ],

    'namespaces' => [

    ],

    'renderers' => [
        'edge' => [
            EdgeRenderer::class,
            ['edge.php', 'blade.php']
        ],
        // We use edge to replace blade
        // 'blade' => [
        //     BladeRenderer::class,
        //     ['blade.php']
        // ],
        'plates' => [
            PlatesRenderer::class,
            ['php']
        ],
        'mustache' => [
            MustacheRenderer::class,
            ['mustache']
        ],
        'twig' => [
            TwigRenderer::class,
            ['twig']
        ],
    ],

    'options' => [
        'cache_path' => WINDWALKER_CACHE . '/renderer'
    ],

    'pagination' => [
        'template' => '@pagination',
        'neighbours' => 4
    ],

    'aliases' => [
        '@pagination' => 'layout.pagination.basic-pagination',
        '@messages' => 'layout.messages.bs5-messages',
        '@csrf' => 'layout.security.csrf',
    ],

    'edge' => [
        'components' => [
            'component' => XComponent::class,
            'template' => XComponent::class,
        ]
    ],

    'providers' => [
        RendererProvider::class,
        EdgeProvider::class,
        FormProvider::class
    ],

    'bindings' => [
        ThemeInterface::class => BootstrapTheme::class,
    ],

    'extends' => [
        //
    ]
];

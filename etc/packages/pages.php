<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\PageBuilder\Addon\Button\ButtonAddon;
use Lyrasoft\Luna\PageBuilder\Addon\Emptyspace\EmptyspaceAddon;
use Lyrasoft\Luna\PageBuilder\Addon\Feature\FeatureAddon;
use Lyrasoft\Luna\PageBuilder\Addon\Image\ImageAddon;
use Lyrasoft\Luna\PageBuilder\Addon\Text\TextAddon;

return [
    'pages' => [
        'addons' => [
            'text' => TextAddon::class,
            'image' => ImageAddon::class,
            'button' => ButtonAddon::class,
            'feature' => FeatureAddon::class,
            'emptyspace' => EmptyspaceAddon::class,
        ],
        'page_extends' => [
            'global.body' => 'luna.page.extends.global.body'
        ],
        'protects' => [
            'theme.'
        ],
        'styles' => [
            'font_size_unit' => 'rem',
            'font_size_scale' => 0.0625
        ],
        'templates' => [
            //
        ]
    ],
];

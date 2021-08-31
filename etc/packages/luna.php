<?php

/**
 * Part of earth project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Lyrasoft\Luna\LunaPackage;
use Lyrasoft\Luna\Repository\ArticleRepository;

return [
    'luna' => [
        'enabled' => true,

        'providers' => [
            LunaPackage::class
        ],

        'content' => [
            'repository' => [
                'article' => ArticleRepository::class
            ]
        ]
    ]
];

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'unicorn' => [
        'enabled' => true,

        'csrf' => [
            'auto_set_cookie' => true,
            'cookie_name' => 'XSRF-TOKEN'
        ],

        'listeners' => [
            \Windwalker\Core\Asset\AssetService::class => [
                \Unicorn\Listener\UnicornAssetSubscriber::class
            ],
            \Unicorn\Listener\DumpOrphansSubscriber::class
        ],

        'providers' => [
            \Unicorn\UnicornPackage::class
        ],

        'file_upload' => [
            'default' => 'default',
            'profiles' => [
                'default' => [
                    'storage' => 'local',
                    'accept' => null,
                ],
                'image' => [
                    'storage' => 'local',
                    'accept' => 'image/*',
                    'resize' => [
                        'enabled' => true,
                        'width' => 1200,
                        'height' => 1200,
                        'crop' => false,
                        'quality' => 85,
                        'output_format' => null
                    ],
                ]
            ]
        ]
    ]
];

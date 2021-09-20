<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Unicorn\Aws\S3Service;

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
                    'storage' => env('UPLOAD_STORAGE_DEFAULT') ?: 'local',
                    'accept' => null,
                ],
                'image' => [
                    'storage' => env('UPLOAD_STORAGE_DEFAULT') ?: 'local',
                    'accept' => 'image/*',
                    'dir' => 'images/{year}/{month}/{day}',
                    'resize' => [
                        'enabled' => true,
                        'width' => 1200,
                        'height' => 1200,
                        'crop' => false,
                        'quality' => 85,
                        'output_format' => null
                    ],
                    'options' => [
                        'ACL' => S3Service::ACL_PUBLIC_READ
                    ]
                ]
            ]
        ]
    ]
];

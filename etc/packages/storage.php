<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Unicorn\Flysystem\FlysystemFactory;
use Unicorn\Provider\StorageProvider;
use Unicorn\Storage\StorageFactory;
use Unicorn\Upload\FileUploadService;
use Unicorn\Upload\FileUploadSubscriber;

return [
    'storage' => [
        'default' => 'local',

        's3' => [
            'default_region' => 'ap-northeast-1'
        ],

        'providers' => [
            StorageProvider::class
        ],

        'listeners' => [
            FileUploadService::class => [
                FileUploadSubscriber::class
            ]
        ],

        'factories' => [
            'instances' => [
                'local' => fn (StorageFactory $factory) => $factory->localStorage(
                    [
                        'path' => env('STORAGE_LOCAL_PATH') ?? 'www/assets/upload',
                        'uri_base' => env('STORAGE_LOCAL_URI_BASE') ?? 'assets/upload',
                    ]
                ),
                's3' => fn (StorageFactory $factory) => $factory->s3Storage(
                    [
                        'access_key' => env('AWS_ACCESS_KEY'),
                        'secret' => env('AWS_SECRET'),
                        'bucket' => env('AWS_S3_BUCKET'),
                        'subfolder' => env('AWS_S3_SUBFOLDER'),
                        'endpoint' => env('AWS_S3_ENDPOINT'),
                        'region' => env('AWS_S3_REGION')
                    ]
                ),
                'flys3' => fn (StorageFactory $factory) => $factory->flysystem(
                    fn (FlysystemFactory $factory) => $factory->s3v3Adapter(
                        [
                            'access_key' => env('AWS_ACCESS_KEY'),
                            'secret' => env('AWS_SECRET'),
                            'bucket' => env('AWS_S3_BUCKET'),
                            'subfolder' => env('AWS_S3_SUBFOLDER'),
                            'endpoint' => env('AWS_S3_ENDPOINT'),
                            'region' => env('AWS_S3_REGION')
                        ]
                    )
                )
            ],
        ]
    ]
];

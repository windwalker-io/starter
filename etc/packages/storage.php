<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Unicorn\Aws\S3Service;
use Unicorn\Flysystem\FlysystemFactory;
use Unicorn\Provider\StorageProvider;
use Unicorn\Storage\StorageFactory;

return [
    'storage' => [
        'default' => 'local',

        's3' => [
            'default_region' => 'ap-northeast-1',
        ],

        'providers' => [
            StorageProvider::class
        ],

        'factories' => [
            'instances' => [
                'local' => fn (StorageFactory $factory) => $factory->localStorage(
                    [
                        'path' => env('STORAGE_LOCAL_PATH') ?? 'assets/upload'
                    ]
                ),
                's3' => fn (StorageFactory $factory) => $factory->s3Storage(
                    [
                        'access_key' => env('AWS_ACCESS_KEY'),
                        'secret' => env('AWS_SECRET'),
                        'bucket' => env('AWS_S3_BUCKET'),
                        'subfolder' => env('AWS_S3_SUBFOLDER'),
                        'endpoint' => env('AWS_S3_ENDPOINT'),
                        'region' => env('AWS_S3_REGION'),
                        'args' => [
                            'ACL' => S3Service::ACL_PUBLIC_READ
                        ]
                    ]
                ),
                'linode' => fn (StorageFactory $factory) => $factory->s3Storage(
                    [
                        'access_key' => env('LINODE_OS_ACCESS_KEY'),
                        'secret' => env('LINODE_OS_SECRET'),
                        'bucket' => env('LINODE_OS_BUCKET'),
                        'subfolder' => env('LINODE_OS_SUBFOLDER'),
                        'endpoint' => env('LINODE_OS_ENDPOINT'),
                        'region' => env('LINODE_OS_REGION'),
                        'args' => [
                            'ACL' => S3Service::ACL_PUBLIC_READ
                        ]
                    ]
                ),
                'flys3' => fn (StorageFactory $factory) => $factory->flysystemStorage(
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

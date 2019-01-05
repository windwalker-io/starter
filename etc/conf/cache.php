<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Disabled cache will make all cache as null storage and not stored to storage.
    // But you can use CacheFactory::createCache('mycache') to ignore this settings.
    'enabled' => false,

    // The default cache profile
    'default' => 'global',

    // Cache profiles
    'profiles' => [
        'global' => [
            // The name or subfolder of different storage settings.
            'name' => 'windwalker',

            // The cache storage, can be storage name or class name.
            // Support storage: file / php_file / forever_file / memcached / null / redis / array / runtime_array
            'storage' => \Windwalker\Cache\Storage\FileStorage::class,

            // Cache serializer decided how to serialize and store data into storage. can be name or class.
            // Support serializers: php / php_file / json / string / raw
            'serializer' => \Windwalker\Cache\Serializer\PhpSerializer::class,

            // Cache time (minutes)
            'time' => 15,

            // If system in debug mode or set cache as disabled, cache will be a NullStorage,
            // Set this to TRUE to force this profile always works.
            'force_enabled' => false
        ],
        'html' => [
            'name' => 'windwalker',
            'storage' => \Windwalker\Cache\Storage\FileStorage::class,
            'serializer' => \Windwalker\Cache\Serializer\RawSerializer::class,
            'time' => 15,
            'force_enabled' => false
        ]
    ]
];

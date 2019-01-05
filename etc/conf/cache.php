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

    // The default sotrage, you can use other storages by use `CacheManager::getCache('name', 'storage')`
    // Support storage: file / php_file / forever_file / memcached / null / redis / array / runtime_array
    'storage' => 'file',

    // Cache serializer decided how to serialize and store data into storage.
    // Support serializers: php / php_file / json / string / raw
    'serializer' => 'php',

    // Cache time (minutes)
    'time' => 15,
];

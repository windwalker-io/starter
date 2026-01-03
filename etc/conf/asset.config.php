<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Asset\AssetProvider;

return [
    // The assets folder in public root, default is `assets`
    'folder' => 'assets',

    // The full assets uri, default is NULL. If you set this uri, it will override `assets.folder`.
    // This is useful if you want to put all assets files on cloud storage.
    'uri' => '',

    'import_map' => [
        'imports' => [
            '@/' => 'js/',
            '@js/' => 'js/',
            '@view/' => 'js/view/',
            '@vendor/' => 'vendor/',
            '@core/' => 'vendor/@windwalker-io/core/dist/',
        ],
        'scopes' => [],
    ],

    'modules' => [
        'main' => '@main',
    ],

    'vite' => [
        'manifest' => '@public/assets/manifest.json',
        'base' => 'resources/assets',
        'server_file' => '@temp/vite-server',
    ],

    'namespace_base' => 'App\\Module',

    'version_file' => '@cache/asset/asset.version',

    'providers' => [
        AssetProvider::class,
    ],
];

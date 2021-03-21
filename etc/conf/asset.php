<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use Windwalker\Core\Asset\AssetProvider;

return [
    // The asset folder in public root, default is `asset`
    'folder' => 'asset',

    // The full asset uri, default is NULL. If you set this uri, it will override `asset.folder`.
    // This is useful if you want to put all asset files on cloud storage.
    'uri' => '',

    'import_map' => [
        'imports' => [
            '@/' => 'js/',
            '@view/' => 'js/view/',
            '@vendor/' => 'js/vendor/'
        ],
        'scopes' => []
    ],

    'namespace_root' => 'App\\Component',

    'version_file' => '@cache/asset/asset.version',

    'providers' => [
        AssetProvider::class,
    ],
];

<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use function Windwalker\cmd;

return [
    'makelink' => [
        'php windwalker asset sync phoenix -f',
        'php windwalker asset sync luna -f',
        'php windwalker asset sync warder -f',
        'php windwalker asset sync unidev -f',
    ],

    // Prepare assets and install dependencies
    'prepare' => [
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install',
        'php windwalker run makelink',
        'yarn install',
        'yarn build default bootstrap',
    ],

    // Prepare for development and reset migration
    'preparedev' => [
        'cross-env NODE_ENV=development php windwalker run prepare',
        'php windwalker unidev bladeopt',
        function (\Windwalker\Core\Application\ApplicationInterface $app) {
            return $app->createProcess('php windwalker migration reset --seed');
        },
        cmd(
            'lyra pstorm sniffer -p',
            "y\nn",
            ignoreError: false
        )
    ],

    // Deploy new version
    'deploy' => [
        'git pull',
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install --no-dev',
        'cross-env APP_ENV=dev php windwalker migration migrate',
        'cross-env NODE_ENV=production php windwalker run prepare',
        'php windwalker asset makesum',
    ],
];

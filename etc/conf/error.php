<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use Windwalker\Core\Provider\ErrorHandlingProvider;

return [
    'error' => [
        'ini' => [
            'error_reporting' => -1
        ],

        'providers' => [
            ErrorHandlingProvider::class
        ],
    ]
];

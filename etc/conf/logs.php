<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

use function Windwalker\ref;

return [
    'default' => 'default',
    'channels' => [
        'none' => ref('di.factories.logs.loggers.none'),
        'default' => ref('di.factories.logs.loggers.default'),
    ]
];

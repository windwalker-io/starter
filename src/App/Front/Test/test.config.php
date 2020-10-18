<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2020 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

return [
    'bindings' => [
        \Windwalker\Queue\Queue::class,
        \Windwalker\Queue\Driver\QueueDriverInterface::class => \Windwalker\Queue\Driver\SyncQueueDriver::class
    ]
];

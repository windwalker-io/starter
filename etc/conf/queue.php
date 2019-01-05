<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    'connection' => env('QUEUE_CONNECTION') ?? 'sync',
    'sync' => [
        'driver' => 'sync'
    ],
    'database' => [
        'driver' => 'database',
        'table' => 'queue_jobs',
        'queue' => 'default',
        'timeout' => '60'
    ],
    'sqs' => [
        'driver' => 'sqs',
        'key' => env('QUEUE_SQS_KEY'),
        'secret' => env('QUEUE_SQS_SECRET'),
        'queue' => 'default',
        'region' => 'ap-northeast-1'
    ],
    'ironmq' => [
        'driver' => 'ironmq',
        'project_id' => env('QUEUE_IRONMQ_PROJECT_ID'),
        'token' => env('QUEUE_IRONMQ_TOKEN'),
        'queue' => 'default',
        'region' => 'mq-aws-eu-west-1-1'
    ],
    'rabbitmq' => [
        'driver' => 'rabbitmq',
        'queue' => 'default'
    ],
    'beanstalkd' => [
        'driver' => 'beanstalkd',
        'queue' => 'default',
        'host' => env('QUEUE_BEANSTALKD') ?? '127.0.0.1',
        'timeout' => '60'
    ],
    'resque' => [
        'driver' => 'resque',
        'queue' => 'default',
        'host' => env('QUEUE_RESQUE_HOST') ?? 'localhost',
        'port' => '6379'
    ],
    'failer' => [
        'driver' => 'database',
        'table' => 'queue_failed_jobs'
    ]
];

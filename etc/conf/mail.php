<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    'from' => [
        'name' => 'Windwalker',
        'email' => 'noreply@windwalker.local'
    ],
    'transport' => env('MAIL_TRANSPORT'),
    'smtp' => [
        'security' => env('MAIL_SMTP_SECURITY') ?? 'tls',
        'port' => env('MAIL_SMTP_PORT') ?? 2525,
        'host' => env('MAIL_SMTP_HOST'),
        'username' => env('MAIL_SMTP_USERNAME'),
        'password' => env('MAIL_SMTP_PASSWORD'),
        'local' => '',
        'verify' => env('MAIL_SMTP_VERIFY') ?? false
    ],
    'sendmail' => env('MAIL_SENDMAIL') ?? '/usr/sbin/sendmail',
    'test_forwards' => env('MAIL_TESTER')
];

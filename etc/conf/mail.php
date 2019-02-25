<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    'enabled' => (bool) (env('MAIL_ENABLED') ?? false),

    // Auto use this as sender if not provided in runtime.
    'from' => [
        'name' => 'Windwalker',
        'email' => 'noreply@windwalker.local'
    ],

    // Transport to send mail (SwiftMailer transport)
    'transport' => env('MAIL_TRANSPORT'),

    // SMTP auth profile.
    'smtp' => [
        'security' => env('MAIL_SMTP_SECURITY') ?? 'tls',
        'port' => env('MAIL_SMTP_PORT') ?? 2525,
        'host' => env('MAIL_SMTP_HOST'),
        'username' => env('MAIL_SMTP_USERNAME'),
        'password' => env('MAIL_SMTP_PASSWORD'),
        'local' => null,
        'verify' => env('MAIL_SMTP_VERIFY') ?? false
    ],

    // Sendmail position
    'sendmail' => env('MAIL_SENDMAIL') ?? '/usr/sbin/sendmail',

    // Auto CC to emails, use (,) separate addresses.
    'cc' => '',

    // Auto BCC to emails, use (,) separate addresses.
    'bcc' => env('MAIL_BCC')
];

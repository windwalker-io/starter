<?php

declare(strict_types=1);

namespace App\Config;

use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Transport\Dsn;
use Windwalker\Core\Factory\MailerFactory;
use Windwalker\Core\Mailer\MailerOptions;
use Windwalker\Core\Provider\MailerProvider;

return [
    'default' => 'default',

    'from' => env('MAIL_FROM') ?: 'Windwalker <noreply@windwalker.local>',

    'reply_to' => env('MAIL_REPLY_TO'),

    'envelope' => [
        // Must use `new \Symfony\Component\Mime\Address('email', 'name')`
        'sender' => null,
        'recipients' => [],
    ],

    'providers' => [
        MailerProvider::class,
    ],

    'bindings' => [
    ],

    'factories' => [
        'instances' => [
            'default' => static fn(MailerFactory $factory) => MailerFactory::mailer(
                static fn () => new MailerOptions(
                    envelope: MailerFactory::createEnvelope($factory->config('envelope') ?? []),
                    dsn: Dsn::fromString(env('MAIL_DSN_DEFAULT')),

                    // dsn: new Dsn(
                    //     scheme: env('MAIL_TRANSPORT'),
                    //     host: env('MAIL_HOST'),
                    //     user: env('MAIL_USER') ?: null,
                    //     password: env('MAIL_PASSWORD') ?: null,
                    //     port: ((int) env('MAIL_PORT')) ?: null,
                    //     options: [
                    //         'verify_peer' => env('MAIL_VERIFY', true)
                    //     ],
                    // ),
                    cc: env('MAIL_CC'),
                    bcc: env('MAIL_BCC')
                )
            ),
        ],
    ],
];

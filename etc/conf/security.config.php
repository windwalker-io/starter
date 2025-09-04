<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Provider\SecurityProvider;
use Windwalker\Crypt\Hasher\Hasher;
use Windwalker\Crypt\Hasher\PasswordHasher;
use Windwalker\Crypt\Symmetric\OpensslCipher;
use Windwalker\Crypt\Symmetric\SodiumCipher;

use function Windwalker\DI\create;

return [
    'crypto' => [
        'default' => 'sodium',

        'factories' => [
            'instances' => [
                'sodium' => static fn() => create(SodiumCipher::class),
                'blowfish' => static fn() => create(OpensslCipher::class, 'blowfish'),
            ],
        ],
    ],

    'hasher' => [
        'default' => 'hash',

        'factories' => [
            'instances' => [
                'hash' => static fn() => create(Hasher::class, 'sha256'),
                'password' => static fn() => create(PasswordHasher::class, PASSWORD_DEFAULT),
            ],
        ],
    ],

    'providers' => [
        SecurityProvider::class,
    ],

    'bindings' => [
        //
    ],
];

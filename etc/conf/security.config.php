<?php

declare(strict_types=1);

namespace App\Config;

use Windwalker\Core\Manager\HasherManager;
use Windwalker\Core\Provider\SecurityProvider;
use Windwalker\Crypt\Hasher\Hasher;
use Windwalker\Crypt\Hasher\PasswordHasher;
use Windwalker\Crypt\Hasher\PasswordHasherInterface;
use Windwalker\Crypt\Symmetric\OpensslCipher;
use Windwalker\Crypt\Symmetric\SodiumCipher;
use Windwalker\DI\Container;

use function Windwalker\DI\create;

return [
    'crypto' => [
        'default' => 'sodium',

        'factories' => [
            'instances' => [
                'sodium' => create(SodiumCipher::class),
                'blowfish' => create(OpensslCipher::class, 'blowfish'),
            ],
        ],
    ],

    'hasher' => [
        'default' => 'hash',

        'factories' => [
            'instances' => [
                'hash' => create(Hasher::class, 'sha256'),
                'password' => create(PasswordHasher::class, PASSWORD_DEFAULT),
            ],
        ],
    ],

    'providers' => [
        SecurityProvider::class,
    ],

    'bindings' => [
        PasswordHasherInterface::class => static function (Container $container) {
            return $container->get(HasherManager::class)->get('password');
        },
    ],
];

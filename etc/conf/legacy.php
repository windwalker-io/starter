<?php

return [
    'session' => [
        'handler' => 'native',
        'expire_time' => '15'
    ],
    'routing' => [
        'debug' => '1',
        'simple_route' => '1'
    ],
    'cache' => [
        'enabled' => '',
        'storage' => 'file',
        'serializer' => 'php',
        'time' => '15'
    ],
    'crypt' => [
        'cipher' => 'blowfish',
        'hash_algo' => 'blowfish',
        'hash_cost' => ''
    ],
    'asset' => [
        'folder' => 'asset',
        'uri' => ''
    ],
    'language' => [
        'debug' => '',
        'locale' => 'en-GB',
        'default' => 'en-GB',
        'format' => 'ini'
    ],
    'console' => [
        'scripts' => [
            'init' => [
                'php windwalker muse init Asuka/Flower sakura.sakuras',
                'php windwalker muse init Asuka/Fsimple sakura.sakuras -t=simple',
                'php windwalker muse init Asuka/Fempty sakura.sakuras -t=empty'
            ],
            'convert' => [
                'php windwalker muse convert Asuka/Flower sakura.sakuras',
                'php windwalker muse convert Asuka/Fsimple sakura.sakuras -t=simple',
                'php windwalker muse convert Asuka/Fempty sakura.sakuras -t=empty'
            ]
        ]
    ],
];

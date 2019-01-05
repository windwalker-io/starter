<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Custom scripts, add some commands here to batch execute. Example:
    // scripts:
    //     foo:
    //         - git pull
    //         - composer install
    //         - php windwalker migration migrate
    //
    // Then just run `$ php windwalker run foo`
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
];

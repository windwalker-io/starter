<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

use function Windwalker\cmd;

return [
    // Prepare assets and install dependencies
    'prepare' => [
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install',
        'yarn install',
        'yarn build',
    ],

    // Prepare for development and reset migration
    'preparedev' => [
        'cross-env NODE_ENV=development php windwalker run prepare',
        function (\Windwalker\Core\Application\ApplicationInterface $app) {
            return $app->createProcess('php windwalker mig:reset --seed -f');
        }
    ],

    // Deploy new version
    'deploy' => [
        'git pull',
        'cross-env COMPOSER_PROCESS_TIMEOUT=600 composer install --no-dev',
        'cross-env APP_ENV=dev php windwalker mig:go -f',
        'cross-env NODE_ENV=production php windwalker run prepare',
        'php windwalker asset:version',
    ],

    'revise' => [
        'php windwalker run revise:route',
        'php windwalker run revise:controller',
        'php windwalker run revise:repo',
        'php windwalker run revise:grid',
        'php windwalker run revise:edit',
    ],

    'gen:all' => [
        'php windwalker g unicorn:controller Admin/SunFlower --model',
        'php windwalker g unicorn:view-grid Admin/SunFlower --model',
        'php windwalker g unicorn:view-edit Admin/SunFlower --model',
    ],

    'revise:route' => [
        'php windwalker generate:revise src/Module/Admin/SunFlower/SunFlowerListView.php vendor/windwalker/unicorn/views/code/view/grid --name=SunFlower --ns=App/Module/Admin/SunFlower',
    ],

    'revise:controller' => [
        'php windwalker generate:revise src/Module/Admin/SunFlower/SunFlowerController.php vendor/windwalker/unicorn/views/code/controller --name=SunFlower --ns=App/Module/Admin/SunFlower',
    ],

    'revise:repo' => [
        'php windwalker generate:revise src/Repository/SunFlowerRepository.php vendor/windwalker/unicorn/views/code/model/repo --name=SunFlower',
    ],

    'revise:grid' => [
        'php windwalker generate:revise src/Module/Admin/SunFlower/SunFlowerListView.php vendor/windwalker/unicorn/views/code/view/grid --name=SunFlower --ns=App/Module/Admin/SunFlower',
        'php windwalker generate:revise "src/Module/Admin/SunFlower/**/*-{list,modal}.*" vendor/windwalker/unicorn/views/code/view/grid/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
        'php windwalker generate:revise "src/Module/Admin/SunFlower/views/list-toolbar.blade.php" vendor/windwalker/unicorn/views/code/view/grid/views/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
        'php windwalker generate:revise "src/Module/Admin/SunFlower/Form/GridForm.php" vendor/windwalker/unicorn/views/code/view/grid/Form/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
    ],

    'revise:edit' => [
        'php windwalker generate:revise src/Module/Admin/SunFlower/SunFlowerEditView.php vendor/windwalker/unicorn/views/code/view/edit --name=SunFlower --ns=App/Module/Admin/SunFlower',
        'php windwalker generate:revise "src/Module/Admin/SunFlower/**/*-edit.*" vendor/windwalker/unicorn/views/code/view/edit/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
        'php windwalker generate:revise "src/Module/Admin/SunFlower/views/edit-toolbar.blade.php" vendor/windwalker/unicorn/views/code/view/edit/views/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
        // 'php windwalker generate:revise "src/Module/Admin/SunFlower/Form/EditForm.php" vendor/windwalker/unicorn/views/code/view/edit/Form/ --name=SunFlower --ns=App/Module/Admin/SunFlower',
    ],
];

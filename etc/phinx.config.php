<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

$config = \Symfony\Component\Yaml\Yaml::parse(__DIR__ . '/config.yml');

$phinx = <<<YML
paths:
    migrations: resources/migrations

environments:
    default_migration_table: migration_log
    default_database: development
    production:
        adapter: mysql
        host: localhost
        name: production_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    development:
        adapter: mysql
        host: localhost
        name: development_db
        user: root
        pass: ''
        port: 3306
        charset: utf8

    testing:
        adapter: mysql
        host: localhost
        name: testing_db
        user: root
        pass: ''
        port: 3306
        charset: utf8
YML;

$phinx = \Symfony\Component\Yaml\Yaml::parse($phinx);

$phinx['paths']['migrations'] = __DIR__ . '/../resources/migrations';

$phinx['environments']['production']['adapter'] = $config['database']['driver'];
$phinx['environments']['production']['host'] = $config['database']['host'];
$phinx['environments']['production']['name'] = $config['database']['name'];
$phinx['environments']['production']['user'] = $config['database']['user'];
$phinx['environments']['production']['pass'] = $config['database']['password'];

$phinx['environments']['production']['adapter'] = $config['database']['driver'];
$phinx['environments']['development']['host'] = $config['database']['host'];
$phinx['environments']['development']['name'] = $config['database']['name'];
$phinx['environments']['development']['user'] = $config['database']['user'];
$phinx['environments']['development']['pass'] = $config['database']['password'];

$phinx['environments']['production']['adapter'] = $config['database']['driver'];
$phinx['environments']['testing']['host'] = $config['database']['host'];
$phinx['environments']['testing']['name'] = $config['database']['name'];
$phinx['environments']['testing']['user'] = $config['database']['user'];
$phinx['environments']['testing']['pass'] = $config['database']['password'];

// Prepare Windwalker DB
$db = \Windwalker\Database\DatabaseFactory::getDbo($config['database']['driver'], $config['database']);

\Windwalker\DataMapper\Adapter\DatabaseAdapter::setInstance(
	new \Windwalker\DataMapper\Adapter\WindwalkerAdapter($db)
);

$db->setQuery('CREATE DATABASE IF NOT EXISTS ' . $db->qn($config['database']['name']))->execute();

$db->select($config['database']['name']);

return $phinx;

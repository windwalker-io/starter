<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

return [
	'packages' => [
		'main' => \Main\MainPackage::class
	],

	'providers' =>[
		'logger' => \Windwalker\Core\Provider\LoggerProvider::class,
		'event'  => \Windwalker\Core\Provider\EventProvider::class,
		'mailer' => \Windwalker\Core\Mailer\MailerProvider::class,
		'swiftmailer' => \Windwalker\Core\Mailer\SwiftMailerProvider::class
	],

	'configs' => [
		100 => WINDWALKER_ETC . '/config.yml',
		500  => WINDWALKER_ETC . '/secret.yml',
	],

	'listeners' => [
		1000 => \Windwalker\Debugger\Listener\Ide\PhpStormMetaListener::class
	],
	
	'path' => [
		'root'       => WINDWALKER_ROOT,
		'bin'        => WINDWALKER_BIN,
		'cache'      => WINDWALKER_CACHE,
		'etc'        => WINDWALKER_ETC,
		'logs'       => WINDWALKER_LOGS,
		'resources'  => WINDWALKER_RESOURCES,
		'source'     => WINDWALKER_SOURCE,
		'temp'       => WINDWALKER_TEMP,
		'templates'  => WINDWALKER_TEMPLATES,
		'vendor'     => WINDWALKER_VENDOR,
		'public'     => WINDWALKER_PUBLIC,
		'migrations' => WINDWALKER_MIGRATIONS,
		'seeders'    => WINDWALKER_SEEDERS,
		'languages'  => WINDWALKER_LANGUAGES,
	]
];

<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

/*
 * Windwalker Core Config
 * -------------------------------------
 * Things you config here will be used in both web and console environment.
 */
return [
	/*
	 * Package Registration
	 * -------------------------------------
	 * Register new packages to Application. The key ia package name (alias).
	 * 
	 * You can use `PackageHelper::getPackage('foo')` to get the packages
	 * you registered here.
	 */
	'packages' => [
		'main' => \Main\MainPackage::class
	],

	/*
	 * Provider Registration
	 * -------------------------------------
	 * Register DI service providers to Container.
	 * 
	 * If you installed 3rd packages from composer, you may add them to here.
	 * The packages you want to register into Container must provides a Windwalker
	 * service provider interface.
	 * 
	 * You can override the default providers in Windwalker core. Just uncomment
	 * the line, use same key name and replace provider class by your own.
	 *
	 * NOTE: You must familiar about how DI Container working, otherwise you may
	 *       break your system.
	 */
	'providers' =>[
		//'logger' => \Windwalker\Core\Provider\LoggerProvider::class,
		//'event'  => \Windwalker\Core\Provider\EventProvider::class,
		//'mailer' => \Windwalker\Core\Mailer\MailerProvider::class,
		//'swiftmailer' => \Windwalker\Core\Mailer\SwiftMailerProvider::class
	],

	/*
	 * Load Config Files
	 * -------------------------------------
	 * Add extra config file that you can customize your application by more settings.
	 *
	 * Use numeric key name to make sure configs has correct ordering to load.
	 * The bigger number will load later and override the previous, so `stc/secret.yml`
	 * will be the latest file and override all configs.
	 */
	'configs' => [
		100 => WINDWALKER_ETC . '/config.yml',
		800 => WINDWALKER_ETC . '/secret.yml',
	],

	/*
	 * Event Listeners
	 * -------------------------------------
	 * Add event listeners to event Dispatcher, this function help us inject logic between
	 * every checkpoint when system running.
	 *
	 * You can add a class name by `'foo' => \Namespace\MyListener::class` or new an object.
	 * We also support callable, use `'onEventName' => ['Class', 'method]` to add callback.
	 *
	 * Closure is not support here because Windwalker config handler will convert it to scalar type,
	 * But you can add closure as listener in runtime: `Ioc::getDispatcher()->listen('event', {Closure})`.
	 *
	 * If you want to add priority to control the execution ordering of listeners, use array to config it.
	 * Example: 'foo' => ['class' => MyListener::class, 'priority' => 300, 'enabled' => boolean]
	 */
	'listeners' => [
		
	],

	/*
	 * Path Define
	 * -------------------------------------
	 * These paths make our core library works correctly.
	 */
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

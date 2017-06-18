<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Utilities\Arr;

/*
 * Windwalker Console Config
 * -------------------------------------
 * Things you config here will be used in console environment.
 */
return Arr::mergeRecursive(include __DIR__ . '/windwalker.php', [
	/*
	 * Package Registration
	 * -------------------------------------
	 * Register new packages to Application. The key ia package name (alias).
	 *
	 * You can use `PackageHelper::getPackage('foo')` to get the packages
	 * you registered here.
	 */
	'packages' => [
		'system' => \Windwalker\SystemPackage\SystemPackage::class,
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
	'providers' => [
//		'console'  => \Windwalker\Core\Provider\ConsoleProvider::class,
//		'logger'   => \Windwalker\Core\Provider\LoggerProvider::class,
//		'event'    => \Windwalker\Core\Provider\EventProvider::class,
//		'database' => \Windwalker\Core\Provider\DatabaseProvider::class,
//		'lang'     => \Windwalker\Core\Provider\LanguageProvider::class,
//		'cache'    => \Windwalker\Core\Provider\CacheProvider::class,
//		'session'  => \Windwalker\Core\Provider\SessionProvider::class,
//		'auth'     => \Windwalker\Core\Provider\UserProvider::class,
//		'security' => \Windwalker\Core\Provider\SecurityProvider::class,
//		'mailer'   => \Windwalker\Core\Mailer\MailerProvider::class,
//		'mailer_adapter' => \Windwalker\Core\Mailer\SwiftMailerProvider::class,
//		'queue'    => \Windwalker\Core\Queue\QueueProvider::class
	],

	/*
	 * Register Commands
	 * -------------------------------------
	 * Add your own command object or class here.
	 *
	 * Uncomment below to override core commands.
	 */
	'console' => [
		'commands' => [
			//'asset'     => \Windwalker\Core\Asset\Command\AssetCommand::class,
			//'migration' => \Windwalker\Core\Migration\Command\MigrationCommand::class,
			//'seed'      => \Windwalker\Core\Seeder\Command\SeedCommand::class,
			//'package'   => \Windwalker\Core\Package\Command\PackageCommand::class
		]
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
		// Add something here...
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
	 * If you want to add priority to control the execution ordering of listeners, use array to config it.
	 * Example: 'foo' => ['class' => MyListener::class, 'priority' => 300, 'enabled' => boolean]
	 */
	'listeners' => [
		// Add something here...
	]
]);

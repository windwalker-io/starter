<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Utilities\ArrayHelper;

return ArrayHelper::merge(
	include __DIR__ . '/windwalker.php',
	[
		'packages' => [
			'system' => \Windwalker\SystemPackage\SystemPackage::class
		],

		'providers' =>[
			'console'  => \Windwalker\Core\Provider\ConsoleProvider::class,
			'logger'   => \Windwalker\Core\Provider\LoggerProvider::class,
			'event'    => \Windwalker\Core\Provider\EventProvider::class,
			'database' => \Windwalker\Core\Provider\DatabaseProvider::class,
			'lang'     => \Windwalker\Core\Provider\LanguageProvider::class,
			'cache'    => \Windwalker\Core\Provider\CacheProvider::class,
			'datetime' => \Windwalker\Core\Provider\DateTimeProvider::class
		],

		'console' => [
			'commends' => [
				
			]
		],

		'configs' => [
		],

		'listeners' => [
		]
	]
);
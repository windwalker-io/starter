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

		],

		'providers' =>[
			'web'      => \Windwalker\Core\Provider\WebProvider::class,
			'whoops'   => \Windwalker\Core\Provider\WhoopsProvider::class,
			'logger'   => \Windwalker\Core\Provider\LoggerProvider::class,
			'event'    => \Windwalker\Core\Provider\EventProvider::class,
			'database' => \Windwalker\Core\Provider\DatabaseProvider::class,
			'router'   => \Windwalker\Core\Provider\RouterProvider::class,
			'lang'     => \Windwalker\Core\Provider\LanguageProvider::class,
			'template' => \Windwalker\Core\Provider\RendererProvider::class,
			'cache'    => \Windwalker\Core\Provider\CacheProvider::class,
			'session'  => \Windwalker\Core\Provider\SessionProvider::class,
			'auth'     => \Windwalker\Core\Provider\UserProvider::class,
			'security' => \Windwalker\Core\Provider\SecurityProvider::class,
			'datetime' => \Windwalker\Core\Provider\DateTimeProvider::class,
			'asset'    => \Windwalker\Core\Asset\AssetProvider::class
		],

		'routing' => [
			'files' => [
				'web' => WINDWALKER_ETC . '/routing.yml'
			]
		],

		'middlewares' => [
			1000 => \Windwalker\Core\Application\Middleware\SessionRaiseMiddleware::class,
			900  => \Windwalker\Core\Application\Middleware\RoutingMiddleware::class
		],

		'configs' => [
		],

		'listeners' => [
			
		]
	]
);
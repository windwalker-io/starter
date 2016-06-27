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
			
		],

		'routing' => [
			'files' => [
				'web' => WINDWALKER_ETC . '/routing.yml'
			]
		],

		'middlewares' => [
			900  => \Windwalker\Core\Application\Middleware\SessionRaiseMiddleware::class,
			800  => \Windwalker\Core\Application\Middleware\RoutingMiddleware::class,
		],

		'configs' => [

		],

		'listeners' => [
			500 => \Windwalker\Listener\SystemListener::class
		]
	]
);

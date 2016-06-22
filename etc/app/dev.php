<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Utilities\ArrayHelper;

return ArrayHelper::merge(
	include __DIR__ . '/web.php',
	[
		'packages' => [
			'_debugger' => \Windwalker\Debugger\DebuggerPackage::class
		],

		'providers' =>[
			'error' => \Windwalker\Core\Provider\WhoopsProvider::class,
		],

		'routing' => [
			'files' => [
				'dev' => WINDWALKER_ETC . '/dev/routing.yml'
			]
		],

		'middlewares' => [
		],

		'configs' => [
			200 => WINDWALKER_ETC . '/dev/config.yml'
		],

		'listeners' => [

		]
	]
);
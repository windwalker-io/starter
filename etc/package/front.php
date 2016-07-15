<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

return [
	'providers' => [

	],

	'routing' => [
		'files' => [
			'main'   => PACKAGE_FRONT_ROOT . '/routing.yml',
			'warder' => \Lyrasoft\Warder\Helper\WarderHelper::getFrontendRouting(),
			'luna'   => \Lyrasoft\Luna\Helper\LunaHelper::getFrontendRouting(),
		]
	],

	'middlewares' => [

	],

	'configs' => [

	],

	'listeners' => [
		'orphans' => \Phoenix\Listener\DumpOrphansListener::class,
		'view' => \Front\Listener\ViewListener::class
	],

	'console' => [
		'commands' => [

		]
	],
];

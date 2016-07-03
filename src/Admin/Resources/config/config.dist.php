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
			'main' => PACKAGE_ADMIN_ROOT . '/routing.yml'
		]
	],

	'middlewares' => [

	],

	'configs' => [

	],

	'listeners' => [
		'orphans' => \Phoenix\Listener\DumpOrphansListener::class
	],

	'console' => [
		'commands' => [

		]
	]
];

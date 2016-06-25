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
			'system' => \Windwalker\SystemPackage\SystemPackage::class,
		],

		'providers' =>[
			
		],

		'console' => [
			'commends' => [

			],
		],

		'configs' => [
		],

		'listeners' => [
		]
	]
);
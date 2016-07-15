<?php
/**
 * Part of luna project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

return [
	/*
	 * Database table name.
	 * ------------------------------------------------
	 */
	'table' => [
		'categories' => 'categories',
		'articles' => 'articles',
		'tags' => 'tags',
		'tag_maps' => 'tag_maps',
		'languages' => 'languages'
	],

	/*
	 * The tags & categories type name to table mapping.
	 * ------------------------------------------------
	 */
	'type_table_map' => [
		'article' => 'articles'
	],

	/*
	 * The frontend package setting.
	 * ------------------------------------------------
	 */
	'frontend' => [
		'package' => 'front',
		'view' => [
			'extends' => '_global.html'
		],
		'redirect' => [
			'language' => 'home'
		],
		'language' => [
			'prefix' => 'luna.',
			'enabled' => '',
			'default' => 'en-GB'
		]
	],

	/*
	 * The backend package setting.
	 * ------------------------------------------------
	 */
	'admin' => [
		'package' => 'admin',
		'view' => [
			'extends' => '_global.admin.admin'
		],
		'redirect' => [
			'language' => 'articles'
		],
		'language' => [
			'prefix' => 'luna.',
			'enabled' => '',
			'locale' => 'en-GB',
			'default' => 'en-GB'
		]
	],

	/*
	 * The modules configuration.
	 * ------------------------------------------------
	 */
	'module' => [
		'includes' => [

		],
		'excludes' => [

		]
	],

	'providers' => [
		'luna' => \Lyrasoft\Luna\Provider\LunaProvider::class,
	],

	'listeners' => [
		'luna' => \Lyrasoft\Luna\Listener\LunaListener::class,
		'editor' => \Lyrasoft\Luna\Listener\EditorListener::class,
		'language' => \Lyrasoft\Luna\Listener\LanguageListener::class,
		'error' => \Lyrasoft\Luna\Listener\ErrorListener::class,
	]
];

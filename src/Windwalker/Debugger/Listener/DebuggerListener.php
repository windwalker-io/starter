<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Listener;

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Event\Event;
use Windwalker\Filesystem\Folder;

/**
 * The DebuggerListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DebuggerListener
{
	/**
	 * Property app.
	 *
	 * @var  WebApplication
	 */
	protected $app;

	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
		$this->app = $event['app'];
	}

	/**
	 * onAfterRender
	 *
	 * @return  void
	 */
	public function __destruct()
	{
		if (!$this->app instanceof WebApplication)
		{
			return;
		}

		$container = $this->app->getContainer();

		$profiler = $container->get('system.profiler');
		$collector = $container->get('system.collector');

		$data = array(
			'profiler'  => $profiler,
			'collector' => $collector
		);

		$data = serialize($data);
		$id = uniqid();

		$dir = WINDWALKER_CACHE . '/profiler/' . DateTime::create('now', DateTime::TZ_LOCALE)->format('Ymd');

		if (!is_dir($dir))
		{
			Folder::create($dir);
		}

		file_put_contents($dir . '/' . $id, $data);
	}
}

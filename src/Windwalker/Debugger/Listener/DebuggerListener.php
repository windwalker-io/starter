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
use Windwalker\Core\Ioc;
use Windwalker\Core\Model\Model;
use Windwalker\Core\Widget\Widget;
use Windwalker\Data\Data;
use Windwalker\Debugger\DebuggerPackage;
use Windwalker\Debugger\Helper\PageRecordHelper;
use Windwalker\Debugger\Helper\TimelineHelper;
use Windwalker\Debugger\Model\DashboardModel;
use Windwalker\Event\Event;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;
use Windwalker\IO\Input;
use Windwalker\Profiler\Point\Collector;
use Windwalker\Profiler\Profiler;

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
	 * Property package.
	 *
	 * @var  DebuggerPackage
	 */
	protected $package;

	/**
	 * Class init.
	 *
	 * @param  DebuggerPackage $package
	 */
	public function __construct(DebuggerPackage $package)
	{
		$this->package = $package;
	}

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
	 * onBeforePackageExecute
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onBeforePackageExecute(Event $event)
	{
		if ($event['hmvc'])
		{
			return;
		}

		/** @var Input $input */
		$package = $event['package'];

		if (!$package instanceof DebuggerPackage)
		{
			return;
		}

		$controller = $event['controller'];
		$input   = $controller->getInput();
		$app     = Ioc::getApplication();
		$session = Ioc::getSession();
		$uri     = Ioc::getUriData();

		/** @var Model $model */
		$model = $controller->getModel('Dashboard');

		if ($input->get('refresh'))
		{
			$input->set('id', null);
			$session->set('debugger.current.id', null);

			$item = $model->getLastItem();

			if ($item)
			{
				$app->redirect($package->router->http($app->get('route.matched'), array('id' => $item['id'])));

				return;
			}
		}

		if (!$id = $input->get('id'))
		{
			// Get id from session
			$id = $session->get('debugger.current.id');

			// If session not exists, get last item.
			if (!$id)
			{
				$item = $model->getLastItem();

				// No item, redirect to front-end.
				if (!$item)
				{
					$app->redirect($uri['base.full'] . $uri['script']);

					return;
				}

				$id = $item['id'];
			}

			// set id to session and redirect
			$session->set('debugger.current.id', $id);

			$app->redirect($package->router->http($app->get('route.matched'), array('id' => $id)));

			return;
		}

		$itemModel = $controller->getModel('Item');

		if (!$itemModel->hasItem($id))
		{
			$session->set('debugger.current.id', null);

			$app->redirect($package->router->http('dashboard'));
		}

		$session->set('debugger.current.id', $id);
	}

	/**
	 * onViewBeforeRender
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onViewBeforeRender(Event $event)
	{
		$theme = $this->package->getDir() . '/Resources/media/css/theme.css';
		$main = $this->package->getDir() . '/Resources/media/css/debugger.css';

		$event['data']->themeStyle = file_get_contents($theme) . "\n\n" . file_get_contents($main);
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

		if ($this->app->getPackage() instanceof DebuggerPackage)
		{
			return;
		}

		ProfilerListener::collectAllInformation();

		$container = $this->app->getContainer();

		$profiler = $container->get('system.profiler');
		$collector = $container->get('system.collector');

		$id = uniqid();
		$collector['id'] = $id;

		$this->pushDebugConsole($collector, $profiler);

		$this->deleteOldFiles();

		$data = array(
			'profiler'  => $profiler,
			'collector' => $collector
		);

		$data = serialize($data);

		$dir = WINDWALKER_CACHE . '/profiler/' . PageRecordHelper::getFolderName($id);

		if (!is_dir($dir))
		{
			Folder::create($dir);
		}

		file_put_contents($dir . '/' . $id, $data);
	}

	/**
	 * pushDebugConsole
	 *
	 * @param Collector $collector
	 * @param Profiler  $profiler
	 */
	protected function pushDebugConsole(Collector $collector, Profiler $profiler)
	{
		// Prepare CSS
		$style = $this->package->getDir() . '/Resources/media/css/console/style.css';

		// Prepare Time
		$points = $profiler->getPoints();
		$first = array_shift($points);
		$last = array_pop($points);
		$time = $profiler->getTimeBetween($first->getName(), $last->getName());
		$memory = $profiler->getMemoryBetween($first->getName(), $last->getName());

		$data = new Data;
		$data->collector = $collector;
		$data->style = file_get_contents($style);
		$data->time = $time * 1000;
		$data->memory = $memory / 1048576;
		$data->queryTimes = $collector['database.query.times'];
		$data->queryTotalTime = $collector['database.query.total.time'] * 1000;
		$data->queryTotalMemory = $collector['database.query.total.memory'] / 1048576;

		$data->timeStyle = TimelineHelper::getStateColor($data->time, 250);
		$data->memoryStyle = TimelineHelper::getStateColor($data->memory, 5);

		$widget = new Widget('debugger.console', null, $this->package->getName());

		echo $widget->render($data);
	}

	/**
	 * deleteOldFiles
	 *
	 * @return  void
	 */
	protected function deleteOldFiles()
	{
		$model = new DashboardModel;

		$files = $model->getFiles();
		$items = array();

		/** @var \SplFileInfo $file */
		foreach ($files as $file)
		{
			$items[$file->getMTime()] = $file;
		}

		krsort($items);

		$i = 0;

		/** @var \SplFileInfo $file */
		foreach ($items as $file)
		{
			$i++;

			if ($i < 100)
			{
				continue;
			}

			File::delete($file->getPathname());
		}
	}
}

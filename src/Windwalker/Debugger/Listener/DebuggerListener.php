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
use Windwalker\Debugger\DebuggerPackage;
use Windwalker\Debugger\Helper\PageRecordHelper;
use Windwalker\Debugger\Model\DashboardModel;
use Windwalker\Event\Event;
use Windwalker\Filesystem\Folder;
use Windwalker\IO\Input;

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

		$data = array(
			'profiler'  => $profiler,
			'collector' => $collector
		);

		$data = serialize($data);
		$id = uniqid();

		$dir = WINDWALKER_CACHE . '/profiler/' . PageRecordHelper::getFolderName($id);

		if (!is_dir($dir))
		{
			Folder::create($dir);
		}

		file_put_contents($dir . '/' . $id, $data);
	}
}

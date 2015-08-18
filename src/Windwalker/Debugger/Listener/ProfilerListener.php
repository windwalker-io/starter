<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Listener;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\DateTime\DateTime;
use Windwalker\Core\Event\EventDispatcher;
use Windwalker\Core\Ioc;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\Debugger\Helper\ComposerInformation;
use Windwalker\DI\Container;
use Windwalker\Event\Event;
use Windwalker\Profiler\Point\Collector;
use Windwalker\Profiler\Profiler;

/**
 * The ProfilerListender class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfilerListener
{
	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $event['app']->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');
		$input     = $container->get('system.input');

		$collector['time']   = DateTime::create('now', DateTime::TZ_LOCALE)->format(DateTime::$format);
		$collector['uri']    = $container->get('uri')->toArray();
		$collector['ip']     = $input->server->getString('REMOTE_ADDR');
		$collector['app.name'] = $event['app']->getName();
		$collector['method'] = $input->getMethod();
		$collector['custom_method'] = strtoupper($input->get('_method'));

		$profiler->mark(__FUNCTION__, array(
			'tag' => 'system.process'
		));
	}

	/**
	 * onAfterRouting
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterRouting(Event $event)
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $event['app']->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		/** @var RestfulRouter $router */
		$router = $event['app']->getRouter();

		$collector['package.name']  = $container->get('current.package')->getName();
		$collector['package.class'] = get_class($container->get('current.package'));
		$collector['main.controller'] = $container->get('current.package')->getTask();
		$collector['route.matcher'] = get_class($router->getMatcher());
		$collector['route.matched'] = iterator_to_array($container->get('current.route'));

		$routes = array();

		foreach ($router->getRoutes() as $route)
		{
			$routes[] = iterator_to_array($route);
		}

		$collector['routes'] = $routes;

		$profiler->mark(__FUNCTION__, array(
			'tag' => 'system.process'
		));
	}

	/**
	 * onAfterPackageExecute
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterPackageExecute(Event $event)
	{
		/**
		 * @var AbstractPackage $package
		 * @var Controller      $controller
		 */
		$package = $event['package'];
		$controller = $event['controller'];

		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $package->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		if (!$collector['controllers'])
		{
			$collector['controllers'] = new DataSet;
		}

		$collector['controllers'][] = new Data(array(
			'controller' => get_class($controller),
			'task'       => $event['task'],
			'input'      => $controller->getInput()->getArray(),
			'variables'  => $event['variables'],
		));

		$profiler->mark(__FUNCTION__, array(
			'tag' => 'package.process'
		));
	}

	/**
	 * onAfterRender
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterRender(Event $event)
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $event['app']->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		$profiler->mark(__FUNCTION__, array(
			'tag' => 'system.process'
		));
	}

	/**
	 * onBeforeRedirect
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onBeforeRedirect(Event $event)
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $event['app']->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		$collector['redirect'] = array(
			'url'   => $event['url'],
			'moved' => $event['moved']
		);
	}

	/**
	 * onAfterRender
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterRespond(Event $event)
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = $event['app']->getContainer();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		$profiler->mark(__FUNCTION__, array(
			'tag' => 'system.process'
		));
	}

	/**
	 * collectAllInformation
	 *
	 * @return  void
	 */
	public static function collectAllInformation()
	{
		/**
		 * @var Container $container
		 * @var Collector $collector
		 * @var Profiler  $profiler
		 */
		$container = Ioc::factory();
		$collector = $container->get('system.collector');
		$profiler  = $container->get('system.profiler');

		// Packages
		$packages = PackageHelper::getPackages();
		$pkgs = array();

		foreach ($packages as $package)
		{
			$pkgs[$package->getName()] = $package->getDir();
		}

		// Windwalker Information
		$collector['windwalker.config'] = Ioc::getConfig()->toArray();
		$collector['windwalker.framework.version'] = ComposerInformation::getInstalledVersion('windwalker/framework');
		$collector['windwalker.core.version'] = ComposerInformation::getInstalledVersion('windwalker/core');

		// PHP
		$collector['php.version']    = PHP_VERSION;
		$collector['php.extensions'] = get_loaded_extensions();

		// Load all inputs
		$collector['request'] = Ioc::getInput()->dumpAllInputs();

		// SQL Explain
		$queries = $collector['database.queries'];
		$db = Ioc::getDatabase();

		foreach ($queries as $data)
		{
			$data['explain'] = $db->setQuery('EXPLAIN ' . $data['query'])->loadAll();
		}

		// Database Information
		$collector['database.driver.name'] = $db->getName();
		$collector['database.driver.class'] = get_class($db);
		$collector['database.info'] = $db->getOptions();

		if ($queries instanceof DataSet)
		{
			$collector['database.queries'] = iterator_to_array($queries);
		}

		// Events
		/** @var EventDispatcher $dispatcher */
		$dispatcher = $container->get('system.dispatcher');

		$collector['event.executed'] = $dispatcher->getCollector();

		$listenersMapping = array();

		foreach ($dispatcher->getListeners() as $eventName => $listeners)
		{
			$listenersMapping[$eventName] = array();

			foreach ($listeners as $listener)
			{
				if ($listener instanceof \Closure)
				{
					continue;
				}

				if (is_object($listener))
				{
					$listener = array(get_class($listener), $eventName);
				}

				$listenersMapping[$eventName][] = $listener;
			}
		}

		$collector['event.listeners'] = $listenersMapping;

		// Headers
		$collector['http.status'] = $collector['exception'] ? $collector['exception']['code'] : http_response_code();
		$collector['headers'] = headers_list();
	}
}

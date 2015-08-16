<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\Provider;

use Windwalker\Debugger\Listener\ProfilerListener;
use Windwalker\Core\Object\NullObject;
use Windwalker\Core\Profiler\NullProfiler;
use Windwalker\Database\Driver\AbstractDatabaseDriver;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Event\ListenerPriority;
use Windwalker\Profiler\Point\Collector;
use Windwalker\Profiler\Point\Point;
use Windwalker\Profiler\Profiler;
use Windwalker\Registry\Registry;

/**
 * The ProfilerProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfilerProvider implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 */
	public function register(Container $container)
	{
		// System profiler
		$closure = function(Container $container)
		{
			$config = $container->get('system.config');

			if ($config->get('system.debug'))
			{
				$profiler = new Profiler('windwalker');

				$profiler->setPoint(new Point('start', $config['execution.start'], $config['execution.memory'], array('tag' => 'system.process')));

				return $profiler;
			}
			else
			{
				return new NullProfiler;
			}
		};

		$container->share('system.profiler', $closure)
			->alias('profiler', 'system.profiler');

		// System collector
		$closure = function(Container $container)
		{
			$config = $container->get('system.config');

			if ($config->get('system.debug'))
			{
				return new Collector;
			}
			else
			{
				return new NullObject;
			}
		};

		$container->share('system.collector', $closure);

		// Event profiler
		$closure = function(Container $container)
		{
			$config = $container->get('system.config');

			if ($config->get('system.debug'))
			{
				return new Profiler('windwalker.event');
			}
			else
			{
				return new NullProfiler;
			}
		};

		$container->share('event.profiler', $closure);

		if ($container->get('system.config')->get('system.debug'))
		{
			$this->registerProfilerListener($container, $container->get('system.config'));
			$this->registerDatabaseProfiler($container, $container->get('system.config'));
			$this->registerEventProfiler($container, $container->get('system.config'));
			$this->registerEmailProfiler($container, $container->get('system.config'));
			$this->registerLogsProfiler($container, $container->get('system.config'));
		}
	}

	/**
	 * registerProfilers
	 *
	 * @param Container $container
	 * @param Registry  $config
	 *
	 * @return  void
	 */
	protected function registerDatabaseProfiler(Container $container, Registry $config)
	{
		$collector = $container->get('system.collector');

		$collector['queries'] = 0;

		$db = $container->get('system.database');

		// Set profiler to DatabaseDriver
		$db->setProfilerHandler(
			function (AbstractDatabaseDriver $db, $sql) use ($container, $collector)
			{
				if (stripos(trim($sql), 'EXPLAIN') === 0)
				{
					return;
				}

				$collector['queries'] = $collector['queries'] + 1;

				$container->get('system.profiler')->mark(
					'query.' . $collector['queries'] . '.before',
					array(
						'tag'     => 'database.query',
						'serial'  => $collector['queries'],
						'process' => 'before',
						'query'   => $sql
					)
				);
			},
			function (AbstractDatabaseDriver $db, $sql, $rows) use ($container, $collector)
			{
				if (stripos(trim($sql), 'EXPLAIN') === 0)
				{
					return;
				}

				$container->get('system.profiler')->mark(
					'query.' . $collector['queries'] . '.after',
					array(
						'tag'     => 'database.query',
						'serial'  => $collector['queries'],
						'process' => 'after',
						'query'   => $sql,
						'rows'    => $rows
					)
				);
			}
		);
	}

	/**
	 * registerProfilerListener
	 *
	 * @param Container $container
	 * @param Registry  $config
	 *
	 * @return  void
	 */
	protected function registerProfilerListener(Container $container, Registry $config)
	{
		$dispatcher = $container->get('system.dispatcher');

		$dispatcher->setDebug(true);

		$dispatcher->addListener(new ProfilerListener, ListenerPriority::LOW);
	}

	/**
	 * registerEventProfiler
	 *
	 * @param Container $container
	 * @param Registry  $config
	 *
	 * @return  void
	 */
	protected function registerEventProfiler(Container $container, Registry $config)
	{
		$dispatcher = $container->get('system.dispatcher');
	}

	/**
	 * registerEmailProfiler
	 *
	 * @param Container $container
	 * @param Registry  $config
	 *
	 * @return  void
	 */
	protected function registerEmailProfiler(Container $container, Registry $config)
	{
		// Not implemented yet
	}

	/**
	 * registerLogsProfiler
	 *
	 * @param Container $container
	 * @param Registry  $config
	 *
	 * @return  void
	 */
	protected function registerLogsProfiler(Container $container, Registry $config)
	{
		// Not implemented yet
	}
}

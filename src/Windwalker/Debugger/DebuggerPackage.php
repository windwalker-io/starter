<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger;

use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Debugger\Listener\DebuggerListener;
use Windwalker\Debugger\Provider\ProfilerProvider;
use Windwalker\DI\Container;
use Windwalker\Event\Dispatcher;

/**
 * The WebProfilerPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DebuggerPackage extends AbstractPackage
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'debugger';

	/**
	 * registerProviders
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	public function registerProviders(Container $container)
	{
		$container->registerServiceProvider(new ProfilerProvider);
	}

	/**
	 * registerListeners
	 *
	 * @param Dispatcher $dispatcher
	 *
	 * @return  void
	 */
	public function registerListeners(Dispatcher $dispatcher)
	{
		parent::registerListeners($dispatcher);

		$dispatcher->addListener(new DebuggerListener($this));
	}
}

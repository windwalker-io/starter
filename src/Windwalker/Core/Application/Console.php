<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Application;

use Windwalker\Application\Application;
use Windwalker\Core\Ioc;
use Windwalker\Core\Migration\Command\MigrationCommand;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Provider\ConsoleProvider;
use Windwalker\Core\Provider\SystemProvider;
use Windwalker\DI\Container;
use Windwalker\Registry\Registry;

/**
 * The Console class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Console extends \Windwalker\Console\Console
{
	/**
	 * The Console title.
	 *
	 * @var  string
	 */
	protected $name = 'Windwalker Console';

	/**
	 * Version of this application.
	 *
	 * @var string
	 */
	protected $version = '2.0';

	/**
	 * The DI container.
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * Property config.
	 *
	 * @var Registry
	 */
	public $config;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->container = $this->container = Ioc::getContainer();

		$this->container->registerServiceProvider(new SystemProvider($this))
			->registerServiceProvider(new ConsoleProvider($this));

		Application::registerProviders($this->container);
	}

	/**
	 * Execute the application.
	 *
	 * @return  int  The Unix Console/Shell exit code.
	 *
	 * @since   {DEPLOY_VERSION}
	 */
	public function execute()
	{
		PackageHelper::registerPackages(Application::getPackages(), $this, $this->container);

		$this->addCommand(new MigrationCommand);

		// @event onBeforeExecute

		// Perform application routines.
		$exitCode = $this->doExecute();

		// @event onAfterExecute

		return $exitCode;
	}
}
 
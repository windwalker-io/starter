<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Package;

use Windwalker\Console\Console;
use Windwalker\Core\Ioc;
use Windwalker\DI\Container;
use Windwalker\Filesystem\Path\PathLocator;

/**
 * The AbstractPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractPackage
{
	/**
	 * DI Container.
	 *
	 * @var Container
	 */
	protected $container = null;

	/**
	 * Bundle name.
	 *
	 * @var  string
	 */
	protected $name = null;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	public function initialise()
	{
		$this->registerProviders($this->getContainer());
	}

	/**
	 * Get the DI container.
	 *
	 * @return  Container
	 *
	 * @since   1.0
	 *
	 * @throws  \UnexpectedValueException May be thrown if the container has not been set.
	 */
	public function getContainer()
	{
		if (!$this->container)
		{
			$this->container = Ioc::getContainer($this->getName());
		}

		return $this->container;
	}

	/**
	 * Set the DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  static Return self to support chaining.
	 *
	 * @since   1.0
	 */
	public function setContainer(Container $container)
	{
		$this->container = $container;

		return $this;
	}

	/**
	 * Get bundle name.
	 *
	 * @return  string  Bundle ame.
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Register providers.
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	public static function registerProviders(Container $container)
	{
	}

	/**
	 * Register commands to console.
	 *
	 * @param Console $console Windwalker console object.
	 *
	 * @return  void
	 */
	public static function registerCommands(Console $console)
	{
		$reflection = new \ReflectionClass(get_called_class());

		$namespace = $reflection->getNamespaceName();

		$path = dirname($reflection->getFileName()) . '/Command';

		if (!is_dir($path))
		{
			return;
		}

		$path = new PathLocator($path);

		foreach ($path as $file)
		{
			/** @var \SplFileInfo $file */
			if (!$file->isDir())
			{
				continue;
			}

			$class = $namespace . '\\Command\\' . $file->getBasename() . '\\' . $file->getBasename() . 'Command';

			$enabled = property_exists($class, 'isEnabled') ? $class::$isEnabled : true;

			if (class_exists($class) && is_subclass_of($class, 'Windwalker\\Console\\Command\\Command') && $enabled)
			{
				$console->addCommand(new $class);
			}
		}
	}
}

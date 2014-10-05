<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Command;

use Windwalker\Console\Command\Command;
use Windwalker\Console\IO\IOInterface;

/**
 * The AbstractCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractCommand extends Command
{
	public function __construct($name = null, IOInterface $io = null, \Windwalker\Console\Command\AbstractCommand $parent = null)
	{
		parent::__construct($name, $io, $parent);

		$ref = new \ReflectionClass($this);

		// Register sub commands
		$dirs = new \DirectoryIterator(dirname($ref->getFileName()));

		foreach ($dirs as $dir)
		{
			if (!$dir->isDir() || $dirs->isDot())
			{
				continue;
			}

			$name = ucfirst($dir->getBasename());

			$class = $ref->getNamespaceName() . '\\' . $name . "\\" . $name . 'Command';

			if (class_exists($class) && $class::$isEnabled)
			{
				$this->addCommand(new $class);
			}
		}
	}
}
 
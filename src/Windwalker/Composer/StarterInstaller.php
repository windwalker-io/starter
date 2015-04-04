<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Composer;

use Composer\Script\CommandEvent;

/**
 * The StarterInstaller class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StarterInstaller
{
	/**
	 * Do install.
	 *
	 * @param CommandEvent $event The command event.
	 *
	 * @return  void
	 */
	public static function install(CommandEvent $event)
	{
		// $root = getcwd();

		$io = $event->getIO();

		$file = __DIR__ . '/../../../etc/config.yml';

		$config = file_get_contents($file);

		$config = str_replace("'This-token-is-not-safe'", md5(uniqid() . 'WindwalkerHash'), $config);

		file_put_contents($file, $config);

		$io->write('Auto created secret key.');

		// Complete
		$io->write('Install complete.');
	}
}

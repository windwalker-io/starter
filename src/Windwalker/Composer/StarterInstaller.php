<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Composer;

use Composer\IO\IOInterface;
use Composer\Script\Event;
use Symfony\Component\Yaml\Yaml;

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
	 * @param Event $event The command event.
	 *
	 * @return  void
	 */
	public static function rootInstall(Event $event)
	{
		$io = $event->getIO();

		static::genSecretConfig($io);

		static::genDatabaseConfig($io);

		// Complete
		$io->write('Install complete.');
	}

	/**
	 * Generate secret code.
	 *
	 * @param IOInterface $io
	 *
	 * @return  void
	 */
	protected static function genSecretConfig(IOInterface $io)
	{
		$file = __DIR__ . '/../../../etc/config.yml';

		$config = file_get_contents($file);

		$salt = $io->ask("\nSalt to generate secret [WindwalkerHash]: ", 'WindwalkerHash');

		$config = str_replace("'This-token-is-not-safe'", md5(uniqid() . $salt), $config);

		file_put_contents($file, $config);

		$io->write('Auto created secret key.');
	}

	/**
	 * Generate database config. will store in: etc/secret.yml.
	 *
	 * @param IOInterface $io
	 *
	 * @return  void
	 */
	protected static function genDatabaseConfig(IOInterface $io)
	{
		if (!$io->askConfirmation("\nDo you want to use database? [Y/n]: ", false))
		{
			return;
		}

		$io->write('');
		$io->write('Database driver only support pdo mysql now.');

		$driver = 'mysql';
		$host = $io->ask("Database host [localhost]: ", 'localhost');
		$name = $io->ask("Database name [acme]: ", 'acme');
		$user = $io->ask("Database user [root]: ", 'root');
		$pass = $io->askAndHideAnswer("Database password: ");
		$prefix = $io->ask("Table prefix [wind_]: ", 'wind_');

		$etc = __DIR__ . '/../../../etc';

		$secret = Yaml::parse(file_get_contents($etc . '/secret.dist.yml'));

		$secret['database'] = array(
			'driver'   => $driver,
			'host'     => $host,
			'user'     => $user,
			'password' => $pass,
			'name'     => $name,
			'prefix'   => $prefix
		);

		file_put_contents($etc . '/secret.yml', Yaml::dump($secret));

		$io->write('');
		$io->write('Database config setting complete.');
		$io->write('');
	}
}

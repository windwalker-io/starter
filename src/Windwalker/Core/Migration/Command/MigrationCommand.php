<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Migration\Command;

use Windwalker\Console\Command\Command;

/**
 * Class Migration
 */
class MigrationCommand extends Command
{
	/**
	 * An enabled flag.
	 *
	 * @var bool
	 */
	public static $isEnabled = true;

	/**
	 * Console(Argument) name.
	 *
	 * @var  string
	 */
	protected $name = 'migration';

	/**
	 * The command description.
	 *
	 * @var  string
	 */
	protected $description = 'Migration system by Phinx';

	/**
	 * The usage to tell user how to use this command.
	 *
	 * @var string
	 */
	protected $usage = 'migration <cmd><command></cmd> <option>[option]</option>';

	/**
	 * Configure command information.
	 *
	 * @return void
	 */
	public function initialise()
	{
		// $this->addArgument();

		parent::initialise();
	}

	/**
	 * Execute this command.
	 *
	 * @return int|void
	 */
	protected function doExecute()
	{
		$argv = $_SERVER['argv'];

		array_shift($argv);
		array_shift($argv);

		if ($argv >= 2)
		{
			$argv[] = '-c';
			$argv[] = realpath(__DIR__ . '/../etc/phinx.config.php');
		}

		$out = system('php ' . WINDWALKER_VENDOR . '/robmorgan/phinx/bin/phinx ' . implode(' ', $argv));

		$this->out($out);
	}
}

<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2016 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;
use Windwalker\Database\Schema\Schema;
use Lyrasoft\Warder\Table\WarderTable;

/**
 * Migration class, version: 20160210041557
 */
class UserInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(WarderTable::USERS, function (Schema $sc)
		{
			$sc->primary('id')->comment('Primary Key');
			$sc->varchar('name')->comment('Full Name');
			$sc->varchar('username')->comment('Login name');
			$sc->varchar('email')->comment('Email');
			$sc->varchar('password')->comment('Password');
			$sc->varchar('avatar')->comment('Avatar');
			$sc->varchar('group')->comment('Group');
			$sc->tinyint('blocked')->comment('0: normal, 1: blocked');
			$sc->varchar('activation')->comment('Activation code.');
			$sc->varchar('reset_token')->comment('Reset Token');
			$sc->datetime('last_reset')->comment('Last Reset Time');
			$sc->datetime('last_login')->comment('Last Login Time');
			$sc->datetime('registered')->comment('Register Time');
			$sc->datetime('modified')->comment('Modified Time');
			$sc->varchar('params')->comment('Params');

			$sc->addIndex('id');
			$sc->addIndex('username');
			$sc->addIndex('email');
		});

		$this->createTable(WarderTable::USER_SOCIALS, function (Schema $sc)
		{
			$sc->integer('user_id')->comment('User ID');
			$sc->varchar('identifier')->comment('User identifier name');
			$sc->char('provider')->length(15)->comment('Social provider');

			$sc->addIndex('user_id');
			$sc->addIndex('identifier');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(WarderTable::USERS);
		$this->drop(WarderTable::USER_SOCIALS);
	}
}

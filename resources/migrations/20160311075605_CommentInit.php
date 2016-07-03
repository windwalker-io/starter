<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Lyrasoft\Luna\Table\LunaTable;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class of CommentInit.
 */
class CommentInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(LunaTable::COMMENTS, function(Schema $sc)
		{
			$sc->primary('id')->comment('Primary Key');
			$sc->integer('target_id')->comment('Target ID');
			$sc->integer('user_id')->comment('User ID');
			$sc->varchar('type')->comment('Type');
			$sc->varchar('title')->comment('Title');
			$sc->text('content')->comment('Content');
			$sc->text('reply')->comment('Reply');
			$sc->integer('reply_user_id')->comment('Reply User ID');
			$sc->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$sc->integer('ordering')->comment('Ordering');
			$sc->datetime('created')->comment('Created Date');
			$sc->integer('created_by')->comment('Author');
			$sc->datetime('modified')->comment('Modified Date');
			$sc->integer('modified_by')->comment('Modified User');
			$sc->text('params')->comment('Params');

			$sc->addIndex('target_id');
			$sc->addIndex('created_by');
			$sc->addIndex('reply_user_id');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::COMMENTS);
	}
}

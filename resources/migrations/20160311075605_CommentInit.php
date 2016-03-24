<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Lyrasoft\Luna\Table\LunaTable;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\Schema;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;

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
		$this->getTable(LunaTable::COMMENTS, function(Schema $sc)
		{
			$sc->addColumn('id',          new Column\Primary)->comment('Primary Key');
			$sc->addColumn('target_id',   new Column\Integer)->comment('Target ID');
			$sc->addColumn('user_id',     new Column\Integer)->comment('User ID');
			$sc->addColumn('type',        new Column\Varchar)->comment('Type');
			$sc->addColumn('title',       new Column\Varchar)->comment('Title');
			$sc->addColumn('content',     new Column\Text)->comment('Content');
			$sc->addColumn('reply',       new Column\Text)->comment('Reply');
			$sc->addColumn('reply_user_id', new Column\Integer)->comment('Reply User ID');
			$sc->addColumn('state',       new Column\Tinyint)->signed(true)->comment('0: unpublished, 1:published');
			$sc->addColumn('ordering',    new Column\Integer)->comment('Ordering');
			$sc->addColumn('created',     new Column\Datetime)->comment('Created Date');
			$sc->addColumn('created_by',  new Column\Integer)->comment('Author');
			$sc->addColumn('modified',    new Column\Datetime)->comment('Modified Date');
			$sc->addColumn('modified_by', new Column\Integer)->comment('Modified User');
			$sc->addColumn('params',      new Column\Text)->comment('Params');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_comments_target_id', 'target_id');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_comments_created_by', 'created_by');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_comments_replay_user_id', 'reply_user_id');
		})->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::COMMENTS);
	}
}

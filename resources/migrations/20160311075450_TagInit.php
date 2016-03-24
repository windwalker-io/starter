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
 * Migration class of TagInit.
 */
class TagInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->getTable(LunaTable::TAGS, function(Schema $sc)
		{
			$sc->addColumn('id',          new Column\Primary)->comment('Primary Key');
			$sc->addColumn('title',       new Column\Varchar)->comment('Title');
			$sc->addColumn('alias',       new Column\Varchar)->comment('Alias');
			$sc->addColumn('state',       new Column\Tinyint)->signed(true)->comment('0: unpublished, 1:published');
			$sc->addColumn('created',     new Column\Datetime)->comment('Created Date');
			$sc->addColumn('created_by',  new Column\Integer)->comment('Author');
			$sc->addColumn('modified',    new Column\Datetime)->comment('Modified Date');
			$sc->addColumn('modified_by', new Column\Integer)->comment('Modified User');
			$sc->addColumn('language',    new Column\Char)->length(7)->comment('Language');
			$sc->addColumn('params',      new Column\Text)->comment('Params');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_tags_alias', 'alias');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_tags_language', 'language');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_tags_created_by', 'created_by');
		})->create(true);

		$this->getTable(LunaTable::TAG_MAPS, function(Schema $sc)
		{
			$sc->addColumn('tag_id',    new Column\Integer)->comment('Tag ID');
			$sc->addColumn('target_id', new Column\Integer)->comment('Target ID');
			$sc->addColumn('type',      new Column\Varchar)->comment('Type');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_tag_maps_tag_id', 'tag_id');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_tag_maps_target_id', 'target_id');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_tag_maps_type', 'type');
		})->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::TAGS)->drop(LunaTable::TAG_MAPS);
	}
}

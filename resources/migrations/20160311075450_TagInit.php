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
 * Migration class of TagInit.
 */
class TagInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(LunaTable::TAGS, function(Schema $sc)
		{
			$sc->primary('id')->comment('Primary Key');
			$sc->varchar('title')->comment('Title');
			$sc->varchar('alias')->comment('Alias');
			$sc->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$sc->datetime('created')->comment('Created Date');
			$sc->integer('created_by')->comment('Author');
			$sc->datetime('modified')->comment('Modified Date');
			$sc->integer('modified_by')->comment('Modified User');
			$sc->char('language')->length(7)->comment('Language');
			$sc->text('params')->comment('Params');

			$sc->addIndex('alias');
			$sc->addIndex('language');
			$sc->addIndex('created_by');
		});

		$this->createTable(LunaTable::TAG_MAPS, function(Schema $sc)
		{
			$sc->integer('tag_id')->comment('Tag ID');
			$sc->integer('target_id')->comment('Target ID');
			$sc->varchar('type')->comment('Type');

			$sc->addIndex('tag_id');
			$sc->addIndex('target_id');
			$sc->addIndex('type');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::TAGS)
			->drop(LunaTable::TAG_MAPS);
	}
}

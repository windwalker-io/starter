<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Lyrasoft\Luna\Admin\Record\CategoryRecord;
use Lyrasoft\Luna\Table\LunaTable;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;
use Windwalker\Database\Schema\Schema;

/**
 * Migration class of CategoryInit.
 */
class CategoryInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(LunaTable::CATEGORIES, function(Schema $schema)
		{
			$schema->primary('id')->comment('Primary Key');
			$schema->integer('parent_id')->comment('Parent ID');
			$schema->integer('lft')->comment('Left Key');
			$schema->integer('rgt')->signed(true)->comment('Right key');
			$schema->integer('level')->signed(true)->comment('Nested Level');
			$schema->varchar('path')->comment('Alias Path');
			$schema->varchar('type')->length(50)->comment('Content Type');
			$schema->varchar('title')->comment('Title');
			$schema->varchar('alias')->comment('Alias');
			$schema->varchar('image')->comment('Main Image');
			$schema->text('description')->comment('Description Text');
			$schema->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$schema->datetime('created')->comment('Created Date');
			$schema->integer('created_by')->comment('Author');
			$schema->datetime('modified')->comment('Modified Date');
			$schema->integer('modified_by')->comment('Modified User');
			$schema->char('language')->length(7)->comment('Language');
			$schema->text('params')->comment('Params');

			$schema->addIndex('alias');
			$schema->addIndex('path');
			$schema->addIndex(['lft', 'rgt']);
			$schema->addIndex('language');
			$schema->addIndex('created_by');
		});

		$record = new CategoryRecord;
		$record->createRoot();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::CATEGORIES);
	}
}

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
use Windwalker\Core\Migration\Schema;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Key;

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
		$this->getTable(LunaTable::CATEGORIES, function(Schema $sc)
		{
			$sc->addColumn('id',          new Column\Primary)->comment('Primary Key');
			$sc->addColumn('parent_id',   new Column\Integer)->comment('Parent ID');
			$sc->addColumn('lft',         new Column\Integer)->comment('Left Key');
			$sc->addColumn('rgt',         new Column\Integer)->signed(true)->comment('Right key');
			$sc->addColumn('level',       new Column\Integer)->signed(true)->comment('Nested Level');
			$sc->addColumn('path',        new Column\Varchar)->comment('Alias Path');
			$sc->addColumn('type',        new Column\Varchar)->length(50)->comment('Content Type');
			$sc->addColumn('title',       new Column\Varchar)->comment('Title');
			$sc->addColumn('alias',       new Column\Varchar)->comment('Alias');
			$sc->addColumn('image',       new Column\Varchar)->comment('Main Image');
			$sc->addColumn('description', new Column\Text)->comment('Description Text');
			$sc->addColumn('state',       new Column\Tinyint)->signed(true)->comment('0: unpublished, 1:published');
			$sc->addColumn('created',     new Column\Datetime)->comment('Created Date');
			$sc->addColumn('created_by',  new Column\Integer)->comment('Author');
			$sc->addColumn('modified',    new Column\Datetime)->comment('Modified Date');
			$sc->addColumn('modified_by', new Column\Integer)->comment('Modified User');
			$sc->addColumn('language',    new Column\Char)->length(7)->comment('Language');
			$sc->addColumn('params',      new Column\Text)->comment('Params');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_categories_alias', 'alias');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_categories_path', 'path');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_categories_lft_rgt', array('lft', 'rgt'));
			$sc->addIndex(Key::TYPE_INDEX, 'idx_categories_language', 'language');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_categories_created_by', 'created_by');
		})->create(true);

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

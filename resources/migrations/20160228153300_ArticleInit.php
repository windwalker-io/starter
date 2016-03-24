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
 * Migration class of ArticleInit.
 */
class ArticleInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->getTable(LunaTable::ARTICLES, function(Schema $sc)
		{
			$sc->addColumn('id',          new Column\Primary)->comment('Primary Key');
			$sc->addColumn('category_id', new Column\Integer)->comment('Category ID');
			$sc->addColumn('title',       new Column\Varchar)->comment('Title');
			$sc->addColumn('alias',       new Column\Varchar)->comment('Alias');
			$sc->addColumn('image',       new Column\Varchar)->comment('Main Image');
			$sc->addColumn('introtext',   new Column\Longtext)->comment('Intro Text');
			$sc->addColumn('fulltext',    new Column\Longtext)->comment('Full Text');
			$sc->addColumn('state',       new Column\Tinyint)->signed(true)->comment('0: unpublished, 1:published');
			$sc->addColumn('ordering',    new Column\Integer)->comment('Ordering');
			$sc->addColumn('created',     new Column\Datetime)->comment('Created Date');
			$sc->addColumn('created_by',  new Column\Integer)->comment('Author');
			$sc->addColumn('modified',    new Column\Datetime)->comment('Modified Date');
			$sc->addColumn('modified_by', new Column\Integer)->comment('Modified User');
			$sc->addColumn('language',    new Column\Char)->length(7)->comment('Language');
			$sc->addColumn('params',      new Column\Text)->comment('Params');

			$sc->addIndex(Key::TYPE_INDEX, 'idx_articles_category_id', 'category_id');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_articles_alias', 'alias');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_articles_language', 'language');
			$sc->addIndex(Key::TYPE_INDEX, 'idx_articles_created_by', 'created_by');
		})->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::ARTICLES);
	}
}

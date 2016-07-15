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
 * Migration class of ArticleInit.
 */
class ArticleInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->createTable(LunaTable::ARTICLES, function(Schema $sc)
		{
			$sc->primary('id')->comment('Primary Key');
			$sc->integer('category_id')->comment('Category ID');
			$sc->varchar('title')->comment('Title');
			$sc->varchar('alias')->comment('Alias');
			$sc->varchar('image')->comment('Main Image');
			$sc->longtext('introtext')->comment('Intro Text');
			$sc->longtext('fulltext')->comment('Full Text');
			$sc->tinyint('state')->signed(true)->comment('0: unpublished, 1:published');
			$sc->integer('ordering')->comment('Ordering');
			$sc->datetime('created')->comment('Created Date');
			$sc->integer('created_by')->comment('Author');
			$sc->datetime('modified')->comment('Modified Date');
			$sc->integer('modified_by')->comment('Modified User');
			$sc->char('language')->length(7)->comment('Language');
			$sc->text('params')->comment('Params');

			$sc->addIndex('category_id');
			$sc->addIndex('alias');
			$sc->addIndex('language');
			$sc->addIndex('created_by');
		});
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->drop(LunaTable::ARTICLES);
	}
}

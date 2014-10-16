<?php

use Phinx\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;

class Init extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    	$db = \Windwalker\Ioc::getDatabase();

		$db->getTable('users')
			->addColumn('id',       DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, null, 'Primary Key', ['primary' => true])
			->addColumn('username', DataType::VARCHAR, Column::SIGNED,   Column::NOT_NULL, null, 'Username')
			->addColumn('email',    DataType::VARCHAR, Column::SIGNED,   Column::NOT_NULL, null, 'Email')
			->addColumn('password', DataType::VARCHAR, Column::SIGNED,   Column::NOT_NULL, null, 'Password')
			->addColumn('group',    DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, null, 'Group')
			->addColumn('params',   DataType::TEXT,    Column::SIGNED,   Column::ALLOW_NULL, null, 'Params')
			->create();

		$db->getTable('products')
			->addColumn('id',          DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, null, 'Primary Key', ['primary' => true])
			->addColumn('title',       DataType::VARCHAR, Column::SIGNED,   Column::NOT_NULL, null, 'Title')
			->addColumn('description', DataType::VARCHAR, Column::SIGNED,   Column::NOT_NULL, null, 'Description')
			->addColumn('author',      DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, null, 'Author')
			->addColumn('views',       DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, 0, 'View')
			->addColumn('downloads',   DataType::INTEGER, Column::UNSIGNED, Column::NOT_NULL, 0, 'Downloads')
			->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$db = \Windwalker\Ioc::getDatabase();

		$db->getTable('users')->drop();
		$db->getTable('products')->drop();
    }
}
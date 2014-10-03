<?php

use Phinx\Migration\AbstractMigration;
use Windwalker\DataMapper\DataMapper;

class AcmeInit extends AbstractMigration
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
    	$this->table('acme_cover')
			->addColumn('text', 'text')
			->addColumn('state', 'integer', array('limit' => 1))
			->save();

		$data = array(
			'text' => '<h1 class="cover-heading">Cover your page.</h1>
                    <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
                    <p class="lead"><a href="#" class="btn btn-lg btn-default">Learn more</a></p>',
			'state' => 1
		);

		(new DataMapper('acme_cover'))->createOne(new \Windwalker\Data\Data($data));
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$this->dropTable('acme_cover');
    }
}
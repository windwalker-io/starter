<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Model;

use Windwalker\Core\Model\DatabaseDatabaseModelRepository;

/**
 * Class CoverModel
 *
 * @since 1.0
 */
class CoverModel extends DatabaseDatabaseModelRepository
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = 'main_cover';

	/**
	 * getContent
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getContent()
	{
		$this->getDataMapper()->findOne(array('id' => 1));
	}
}

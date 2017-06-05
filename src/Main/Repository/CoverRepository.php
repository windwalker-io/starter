<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Repository;

use Windwalker\Core\Repository\DatabaseModelRepository;

/**
 * Class CoverRepository
 *
 * @since 1.0
 */
class CoverRepository extends DatabaseModelRepository
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
		return $this->getDataMapper()->findOne(['id' => 1]);
	}
}

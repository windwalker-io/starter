<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

namespace Main\Model;

use Windwalker\Core\Model\Model;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * Class CoverModel
 *
 * @since 1.0
 */
class CoverModel extends Model
{
	/**
	 * getContent
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getContent()
	{
		try
		{
			return with(new DataMapper('main_cover'))->findOne(array('id' => 1));
		}
		catch (\RuntimeException $e)
		{
			return new Data;
		}
	}
}

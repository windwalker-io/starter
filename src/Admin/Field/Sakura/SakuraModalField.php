<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Field\Sakura;

use Admin\Table\Table;
use Phoenix\Field\ModalField;

/**
 * The SakuraModalField class.
 *
 * @since  1.0
 */
class SakuraModalField extends ModalField
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = Table::SAKURAS;

	/**
	 * Property view.
	 *
	 * @var  string
	 */
	protected $view = 'sakuras';

	/**
	 * Property package.
	 *
	 * @var  string
	 */
	protected $package = 'admin';

	/**
	 * Property titleField.
	 *
	 * @var  string
	 */
	protected $titleField = 'title';

	/**
	 * Property keyField.
	 *
	 * @var  string
	 */
	protected $keyField = 'id';
}

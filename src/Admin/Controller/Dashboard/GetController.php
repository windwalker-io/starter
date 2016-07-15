<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Controller\Dashboard;

use Admin\Model\DashboardModel;
use Admin\View\Dashboard\DashboardHtmlView;
use Lyrasoft\Luna\Admin\Model\ArticlesModel;
use Phoenix\Controller\Display\DisplayController;
use Windwalker\Core\Model\ModelRepository;

/**
 * The GetController class.
 * 
 * @since  1.0
 */
class GetController extends DisplayController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'dashboard';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'dashboard';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'dashboards';

	/**
	 * Property model.
	 *
	 * @var  DashboardModel
	 */
	protected $model;

	/**
	 * Property view.
	 *
	 * @var  DashboardHtmlView
	 */
	protected $view;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		parent::prepareExecute();
	}

	/**
	 * prepareModelState
	 *
	 * @param   ModelRepository $model
	 *
	 * @return  void
	 */
	protected function prepareModelState(ModelRepository $model)
	{
		/** @var ArticlesModel $model */
		$model = $this->getModel('Articles');

		parent::prepareModelState($model);
	}

	/**
	 * postExecute
	 *
	 * @param mixed $result
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
		return parent::postExecute($result);
	}
}

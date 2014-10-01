<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\View;

use Windwalker\Utilities\Queue\Priority;
use Windwalker\Data\Data;
use Windwalker\Renderer\RendererInterface;
use Windwalker\Core\View\Helper\ViewHelper;

/**
 * Class HtmlView
 *
 * @since 1.0
 */
class HtmlView extends \Windwalker\View\HtmlView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = null;

	/**
	 * Method to instantiate the view.
	 *
	 * @param   array             $data     The data array.
	 * @param   RendererInterface $renderer The renderer engine.
	 *
	 * @internal param \Windwalker\Model\ModelInterface $model The model object.
	 */
	public function __construct($data = array(), RendererInterface $renderer = null)
	{
		parent::__construct($data, $renderer);

		$this->renderer->addPath(WINDWALKER_TEMPLATE . '/_global', Priority::NORMAL);

		$this->initialise();
	}

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
	}

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
	}

	/**
	 * getData
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getData()
	{
		if (!$this->data)
		{
			$this->data = new Data;
		}

		return $this->data;
	}

	/**
	 * setData
	 *
	 * @param   \Windwalker\Data\Data $data
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * render
	 *
	 * @return  string
	 *
	 * @throws \RuntimeException
	 */
	public function render()
	{
		$this->getName();

		$data = $this->getData();

		$this->prepareData($data);

		$this->prepareGlobals($data);

		return $this->renderer->render($this->getLayout(), (array) $data);
	}

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		if (!$this->name)
		{
			$name = get_called_class();

			// If we are using this class as default view, return default name.
			if ($name == __CLASS__)
			{
				return $this->name = 'default';
			}

			$name = explode('\\', $name);

			array_pop($name);

			$name = array_pop($name);

			$this->name = strtolower($name);
		}

		return $this->name;
	}

	/**
	 * prepareGlobals
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareGlobals($data)
	{
		$data->view = new Data;

		$data->view->name = $this->getName();
		$data->view->layout = $this->getLayout();

		$data->bind(ViewHelper::getGlobalVariables());
	}
}
 
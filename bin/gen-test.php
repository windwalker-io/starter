#!/usr/bin/env php
<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

use Windwalker\Application\AbstractCliApplication;
use Windwalker\Console\Prompter\ValidatePrompter;
use Windwalker\Filesystem\Path;
use Windwalker\String\StringNormalise;
use Windwalker\Utilities\Reflection\ReflectionHelper;

include_once __DIR__ . '/../vendor/autoload.php';

define('WINDWALKER_ROOT', realpath(__DIR__ . '/..'));
define('WINDWALKER_CORE_ROOT', realpath(__DIR__ . '/../vendor/windwalker/core'));

/**
 * Class GenTest
 *
 * @since 1.0
 */
class GenTest extends AbstractCliApplication
{
	/**
	 * Execute the controller.
	 *
	 * @return  boolean  True if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function doExecute()
	{
		$package = $this->io->getArgument(0, new ValidatePrompter('Enter package name: '));
		$class   = $this->io->getArgument(1, new ValidatePrompter('Enter class name: '));
		$class   = StringNormalise::toClassNamespace($class);
		$target  = $this->io->getArgument(2, $package . '\\' . $class . 'Test');
		$target  = StringNormalise::toClassNamespace($target);
		$package = ucfirst($package);

		if (!class_exists($class))
		{
			$class = 'Windwalker\\Core\\' . $package . '\\' . $class;
		}

		if (!class_exists($class))
		{
			$this->out('Class not exists: ' . $class);

			exit();
		}

		$replace = $this->replace;

		$ref = new \ReflectionClass($class);

		$replace['origin.class.dir']  = dirname($ref->getFileName());
		$replace['origin.class.file'] = $ref->getFileName();
		$replace['origin.class.name'] = $ref->getName();
		$replace['origin.class.shortname'] = $ref->getShortName();
		$replace['origin.class.namespace'] = $ref->getNamespaceName();

		$replace['test.dir'] = WINDWALKER_ROOT . DIRECTORY_SEPARATOR . 'test';

		$replace['test.class.name'] = 'Windwalker\\Test\\' . $target;
		$replace['test.class.file'] = Path::clean($replace['test.dir'] . DIRECTORY_SEPARATOR . $target . '.php');
		$replace['test.class.dir']  = dirname($replace['test.class.file']);
		$replace['test.class.shortname'] = $this->getShortname(StringNormalise::toClassNamespace($replace['test.class.name']));
		$replace['test.class.namespace'] = $this->getNamespace($replace['test.class.name']);

		$this->replace = $replace;

		$config = new Registry;

		// Set replace to config.
		foreach ($this->replace as $key => $val)
		{
			$config->set('replace.' . $key, $val);
		}

		$methods = $ref->getMethods(\ReflectionMethod::IS_PUBLIC);
		$methodTmpl = file_get_contents(GENERATOR_BUNDLE_PATH . '/Template/test/testMethod.php');
		$methodCodes = [];

		foreach ($methods as $method)
		{
			$config['replace.origin.method'] = $method->getName();
			$config['replace.test.method'] = ucfirst($method->getName());

			$methodCodes[] = StringHelper::parseVariable($methodTmpl, $config->get('replace'));
		}

		$config['replace.test.methods'] = implode("", $methodCodes);

		$this->replace = $config->get('replace');
		$this->config = $config;

		$this->doAction(new GenClassAction);

		$this->out('Generate test class: ' . $replace['test.class.name'] . ' to file: ' . $replace['test.class.file'])->out();

		return true;
	}

	/**
	 * getShortname
	 *
	 * @param string $class
	 *
	 * @return  mixed
	 */
	protected function getShortname($class)
	{
		$class = explode('\\', $class);

		return array_pop($class);
	}

	/**
	 * getNamespace
	 *
	 * @param string $class
	 *
	 * @return  string
	 */
	protected function getNamespace($class)
	{
		$class = explode('\\', $class);

		array_pop($class);

		return implode('\\', $class);
	}
}

$app = new GenTest;
$app->execute();
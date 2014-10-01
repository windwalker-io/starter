<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Error;

use Formosa\Application\WebApplication;
use Windwalker\Renderer\PhpRenderer;

/**
 * Class SimpleErrorHandler
 *
 * @since 1.0
 */
class SimpleErrorHandler
{
	/**
	 * The json error handler.
	 *
	 * @param integer $errno      The level of the error raised, as an integer.
	 * @param string  $errstr     The error message, as a string.
	 * @param string  $errfile    The filename that the error was raised in, as a string.
	 * @param integer $errline    The line number the error was raised at, as an integer.
	 * @param mixed   $errcontext An array that points to the active symbol table at the point the error occurred.
	 *                            In other words, errcontext will contain an array of every variable that existed
	 *                            in the scope the error was triggered in. User error handler must not modify error context.
	 *
	 * @throws \ErrorException
	 * @return  void
	 */
	public static function error($errno ,$errstr ,$errfile, $errline ,$errcontext)
	{
		$content = sprintf('%s. File: %s (line: %s)', $errstr, $errfile, $errno);

		$exception = new \ErrorException($content, $errno, 1, $errfile, $errline);

		static::respond($exception);
	}

	/**
	 * The exception handler.
	 *
	 * @param \Exception $exception The exception object.
	 *
	 * @return  void
	 */
	public static function exception(\Exception $exception)
	{
		try
		{
			static::respond($exception);
		}
		catch (\Exception $e)
		{
			$msg = "Infinity loop in exception handler. \n\nException:\n" . $e;

			exit($msg);
		}
	}

	/**
	 * respond
	 *
	 * @param \Exception $exception
	 *
	 * @return  void
	 */
	protected static function respond($exception)
	{
		$body = (new PhpRenderer(__DIR__ . '/../Resources/Template'))->render('error.error', array('exception' => $exception));

		$app = new WebApplication;

		$app->setBody($body)->output();

		die;
	}

	/**
	 * registerErrorHandler
	 *
	 * @return  void
	 */
	public static function registerErrorHandler()
	{
		restore_error_handler();
		restore_exception_handler();

		set_error_handler(array(get_called_class(), 'error'));
		set_exception_handler(array(get_called_class(), 'exception'));
	}
}
 
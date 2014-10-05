<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Language;

use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Facade\Facade;
use Windwalker\Language\Language as WindwalkerLanguage;
use Windwalker\Language\LanguageNormalize;

/**
 * The LanguageHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Language extends Facade
{
	/**
	 * Property key.
	 *
	 * @var  string
	 */
	protected static $key = 'system.language';

	/**
	 * load
	 *
	 * @param string $file
	 *
	 * @return  void
	 */
	public static function load($file)
	{
		/** @var WindwalkerLanguage $language */
		$language = static::getInstance();

		$config = static::getContainer()->get('system.config');

		$format  = $config['language.format']  ? : 'ini';
		$default = $config['language.default'] ? : 'en-GB';
		$locale  = $config['language.locale']  ? : 'en-GB';

		$default = LanguageNormalize::toLanguageTag($default);
		$locale = LanguageNormalize::toLanguageTag($locale);

		$path = '%s/%s.%s';

		$language->load(sprintf($path, $default, $file, $format), $format);

		// If locale not equals default locale, load it to override default
		if ($locale != $default)
		{
			$language->load(sprintf($path, $locale, $file, $format), $format);
		}
	}

	/**
	 * translate
	 *
	 * @param   string $string
	 *
	 * @return  string
	 */
	public static function translate($string)
	{
		return static::getInstance()->translate($string);
	}

	/**
	 * sprintf
	 *
	 * @param string $format  The format string is composed of zero or more directives:
	 *                        ordinary characters (excluding %) that are
	 *                        copied directly to the result, and conversion
	 *                        specifications, each of which results in fetching its
	 *                        own parameter. This applies to both sprintf and printf.
	 *
	 *                        Each conversion specification consists of a percent sign
	 *                        (%), followed by one or more of these
	 *                        elements, in order:
	 *                        An optional sign specifier that forces a sign
	 *                        (- or +) to be used on a number. By default, only the - sign is used
	 *                        on a number if it's negative. This specifier forces positive numbers
	 *                        to have the + sign attached as well, and was added in PHP 4.3.0.
	 * @param mixed $args     [optional]
	 *
	 * @return  string
	 */
	public static function sprintf($format, $args = null)
	{
		return call_user_func_array(array(static::getInstance(), 'sprintf'), func_get_args());
	}

	/**
	 * plural
	 *
	 * @param string  $string
	 * @param integer $count
	 *
	 * @return  string
	 */
	public static function plural($string, $count = 1)
	{
		return static::getInstance()->plural($string, $count);
	}
}
 
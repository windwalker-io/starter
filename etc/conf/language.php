<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Language debug will mark untranslated string by `??` and stored orphan in Languages object.
    'debug' => false,

    // The current locale
    'locale' => 'en-GB',

    // The default locale, if translated string in current locale not found, will fallback to default locale.
    'default' => 'en-GB',

    // Default languaghe file format, you can use other format in runtime by `Translator::loadFile($file, 'yaml')`
    'format' => 'ini'
];

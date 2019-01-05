<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // The Crypt cipher method.
    // Support ciphers: blowfish (bf) / aes-256 (aes) / 3des / php_aes / sodium
    'cipher' => 'blowfish',

    // The hashing algorithm
    // Support algorithms: blowfish (bf) / md5 / sha256 / sha512 / argon2 / scrypt
    'hash_algo' => 'blowfish',

    // The hashing cost depends on different algorithms. Keep default if you don't know how to use it.
    'hash_cost' => null
];

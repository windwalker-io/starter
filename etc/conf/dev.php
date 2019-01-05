<?php
/**
 * Part of phoenix project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

return [
    // Allow IPs to access dev.php
    // Use comma to separate IPs
    'allow_ips' => env('DEV_ALLOW_IPS') ?? ''
];

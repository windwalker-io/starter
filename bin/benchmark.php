<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

$start_time = microtime(TRUE);

$url    = isset($argv[1]) ? $argv[1] : exit("Please type utl to benchmark.\n");
$second = isset($argv[2]) ? $argv[2] : 5;

$i = 1;

while (true)
{
	$r = file_get_contents($argv[1]);

	if ($i == 1)
	{
		echo $r . "\n\n----------------------\nStart Benchmark:\n";
	}

	echo '.';

	$current_time = microtime(TRUE);

	if (($current_time - $start_time) >= $second)
	{
		echo sprintf("\n\n%s times in %s seconds.", $i, $second) . "\n\n";

		die;
	}

	$i++;
}

$end_time = microtime(TRUE);

echo "\n\n" . $end_time - $start_time . "\n";
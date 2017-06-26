<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT Taiwan, Inc. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later. see LICENSE
 */

use Windwalker\Core\Utilities\Debug\BacktraceHelper;

/** @var $exception Exception */
$traces = BacktraceHelper::normalizeBacktraces($exception->getTrace());
?>
<style>
	body {
		margin: 0;
		padding: 30px;
		font-family: Helvetica, Arial, Verdana, sans-serif;
		font-size: 15px;
		line-height: 150%;
	}

	h1 {
		margin      : 0;
		font-size   : 48px;
		font-weight : normal;
		line-height : 48px;
		border-bottom: 1px solid #eee;
	}

	p.lead {
		font-size: 1.5em;
	}

	strong {
		display : inline-block;
		width   : 85px;
	}

	table {
		border-spacing: 0;
		border-collapse: collapse;
		width: 100%;
	}

	table tbody tr td {
		padding: 8px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #ddd;
		font-family: monospace;
	}

	table > tbody > tr:nth-child(odd) > td {
		background-color: #f9f9f9;
	}

    body #error-container {
        position: absolute;
        top: 0;
        padding-top: 30px;
        width: 100%;
        background: white;
    }
</style>

<div id="error-container">
    <h1>Windwalker Error</h1>

    <p class="lead">
        <?php echo $exception->getMessage(); ?>
    </p>

    <br /><br />

    <h2>Error Details</h2>

    <div>
        <strong>Type:</strong> <?php echo get_class($exception); ?>
    </div>
    <div>
        <strong>File:</strong> <?php echo BacktraceHelper::replaceRoot($exception->getFile()); ?>
    </div>
    <div>
        <strong>Line:</strong> <?php echo $exception->getLine(); ?>
    </div>

    <h2>BackTrace</h2>

    <table>
        <?php foreach ($traces as $i => $trace): ?>
            <tr>
                <td>
                    #<?php echo $i ; ?>
                </td>
                <td>
                    <?php echo $trace['function']; ?>
                </td>
                <td>
                    <?php echo $trace['file']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Debugger\Html\BootstrapKeyValueGrid;
use Windwalker\Profiler\Point\Collector;
use Windwalker\Utilities\ArrayHelper;

$this->extend('_global.html');

/**
 * @var  Collector  $collector
 */
?>

<?php $this->block('page_title') ?>System<?php $this->endblock(); ?>

<?php $this->block('content') ?>
<h2>Windwalker</h2>

<table class="table table-bordered">
	<tbody>
	<tr>
		<td width="30%">
			Framework Version
		</td>
		<td>
			<?php echo $collector['windwalker.framework.version']; ?>
		</td>
	</tr>
	<tr>
		<td>
			Core Version
		</td>
		<td>
			<?php echo $collector['windwalker.core.version']; ?>
		</td>
	</tr>
	<tr>
		<td width="30%">
			PHP
		</td>
		<td>
			<?php echo $collector['php.version']; ?>
		</td>
	</tr>
	</tbody>
</table>

	<br /><br />

<h2>Custom Data</h2>

<?php
echo BootstrapKeyValueGrid::create()
	->addHeader()
	->addItems((array) $collector['custom.data']);
?>

<div class="alert alert-info">
	<p>
		Add Custom data by use <code>Windwalker\Debugger\Helper\DebuggerHelper::addCustomData('key', $value)</code>
	</p>
</div>

<br /><br />

<h2>Config</h2>

<?php
echo BootstrapKeyValueGrid::create()
	->addHeader()
	->addItems(ArrayHelper::flatten($collector['windwalker.config']));
?>

<?php $this->endblock() ?>
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Profiler\Profiler;

$this->extend('_global.html');

/**
 * @var  Profiler  $profiler
 */
?>

<?php $this->block('page_title') ?>Timeline<?php $this->endblock(); ?>

<?php $this->block('content') ?>
<h2>System Process</h2>

<table class="table bordered">
	<thead>
	<tr>
		<th>
			Mark
		</th>
		<th>
			Total Time
		</th>
		<th>
			Time
		</th>
		<th>
			Total Memory
		</th>
		<th>
			Memory
		</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($timeline as $name => $point): ?>
		<tr>
			<td>
				<?php echo $name; ?>
			</td>
			<td>
				<?php echo $point['total_time'] ?>
			</td>
			<td>
				<?php echo $point['time'] ?>
			</td>
			<td>
				<?php echo $point['memory'] ?>
			</td>
			<td>
				<?php echo $point['total_memory'] ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php $this->endblock() ?>
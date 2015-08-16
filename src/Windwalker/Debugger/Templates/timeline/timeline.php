<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

?>
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
	<?php foreach ((array) $timeline['timeline'] as $name => $point): ?>
		<tr>
			<td>
				<?php echo $name; ?>
			</td>
			<td>
				<span class="label label-<?php echo $point['total_time']['style'] ?>">
					<?php echo round($point['total_time']['value'], 2) ?> ms
				</span>
			</td>
			<td>
				<span class="label label-<?php echo $point['time']['style'] ?>">
					<?php echo round($point['time']['value'], 2) ?> ms
				</span>
			</td>
			<td>
				<span class="label label-<?php echo $point['total_memory']['style'] ?>">
					<?php echo round($point['total_memory']['value'], 2) ?> MB
				</span>
			</td>
			<td>
				<span class="label label-<?php echo $point['memory']['style'] ?>">
					<?php echo round($point['memory']['value'], 2) ?> MB
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>

	<tfoot>
	<tr>
		<td colspan="20">
			<span class="label label-info">Avg Time: <?php echo round($timeline['avg_time'], 2) ?> ms</span>
			/
			<span class="label label-info">Total Time: <?php echo round($timeline['full_time'], 2) ?> ms</span>
			-
			<span class="label label-info">Avg Memory: <?php echo round($timeline['avg_memory'], 2) ?> MB</span>
			/
			<span class="label label-info">Total Memory: <?php echo round($timeline['full_memory'], 2) ?> MB</span>
		</td>
	</tr>
	</tfoot>
</table>
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Data\DataSet;
?>

<div class="panel panel-<?php echo $timeline['time']['style'] ?>">
	<div class="panel-heading">
		<h3 class="panel-title">
			Query: <?php echo $timeline['data']['serial'] ?>
		</h3>
	</div>
	<div class="panel-body">
		<pre><?php echo $timeline['data']['query']; ?></pre>
		<hr />
		Query Time: <span class="label label-<?php echo $timeline['time']['style'] ?>"><?php echo round($timeline['time']['value'], 2) ?> ms</span>
		Memory: <span class="label label-<?php echo $timeline['memory']['style'] ?>"><?php echo round($timeline['memory']['value'], 3) ?> MB</span>
		Return Rows: <span class="label label-info"><?php echo $timeline['data']['rows'] ?></span>
	</div>
	<?php if ($timeline['data']['explain']): ?>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>ID</th>
				<th>Select Type</th>
				<th>Table</th>
				<th>Type</th>
				<th>Possible Keys</th>
				<th>Key</th>
				<th>Key Length</th>
				<th>Reference</th>
				<th>Rows</th>
				<th>Extra</th>
			</tr>
			</thead>
			<tbody>
			<?php $explain = new DataSet($timeline['data']['explain']); ?>
			<?php foreach ($explain as $item): ?>
				<tr>
					<td><?php echo $item->id ?></td>
					<td><?php echo $item->select_type ?></td>
					<td><?php echo $item->table ?></td>
					<td><?php echo $item->type ?></td>
					<td><?php echo $item->possible_keys ?></td>
					<td><strong><?php echo $item->key ?></strong></td>
					<td><?php echo $item->key_len ?></td>
					<td><?php echo $item->ref ?></td>
					<td><?php echo $item->rows ?></td>
					<td><?php echo $item->Extra ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

</div>

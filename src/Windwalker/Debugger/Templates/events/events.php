<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

?>
<table class="table table-bordered">
	<thead>
	<tr>
		<th>Event Name</th>
		<th>Times</th>
		<th>Listener</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($events as $event): ?>
		<tr>
			<td>
				<?php echo $event['name']; ?>
			</td>
			<td>
				<?php echo $event['times']; ?>
			</td>
			<td>
				<code><?php echo $event['listener']; ?></code>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
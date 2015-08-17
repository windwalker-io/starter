<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

$this->extend('_global.html');
?>

<?php $this->block('page_title') ?>Dashboard<?php $this->endblock(); ?>

<?php $this->block('content') ?>
<table class="table table-bordered">
	<thead>
	<tr>
		<th>ID</th>
		<th>See</th>
		<th>IP</th>
		<th>Method</th>
		<th>URL</th>
		<th>Time</th>
		<th>Info</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($items as $item): ?>
		<tr>
			<td>
				<a class="text-muted" href="<?php echo $item->link ?>">
					<?php echo $item->id; ?>
				</a>
			</td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo $item->link ?>">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
			</td>
			<td>
				<?php echo $item->ip; ?>
			</td>
			<td>
				<?php echo $item->method; ?>
			</td>
			<td>
				<a class="text-muted" href="<?php echo $item->url; ?>" target="_blank">
					<?php echo $item->url; ?> <small class="glyphicon glyphicon-new-window"></small>
				</a>
			</td>
			<td>
				<?php echo $item->time; ?>
			</td>
			<td>
				<span class="<?php echo $item->status_style ?>"
					data-toggle="tooltip" data-placement="top" title="Http Status: <?php echo $item->status ?>">
					<?php echo $item->status; ?>
				</span>
				&nbsp;
				<?php if ($item->exception->notNull()): ?>
				    <span class="label label-danger" data-toggle="tooltip" data-placement="top" title="<?php echo $item->exception->type ?>">E</span>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

<?php $this->endblock(); ?>
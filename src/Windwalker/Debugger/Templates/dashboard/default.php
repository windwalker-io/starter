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
					<svg class="icon icon-eye">
						<use xlink:href="#icon-eye"></use>
						<symbol id="icon-eye" viewBox="0 0 1024 1024">
							<title>eye</title>
							<path class="path1" d="M512 192c-223.318 0-416.882 130.042-512 320 95.118 189.958 288.682 320 512 320 223.312 0 416.876-130.042 512-320-95.116-189.958-288.688-320-512-320zM764.45 361.704c60.162 38.374 111.142 89.774 149.434 150.296-38.292 60.522-89.274 111.922-149.436 150.296-75.594 48.218-162.89 73.704-252.448 73.704-89.56 0-176.858-25.486-252.452-73.704-60.158-38.372-111.138-89.772-149.432-150.296 38.292-60.524 89.274-111.924 149.434-150.296 3.918-2.5 7.876-4.922 11.86-7.3-9.96 27.328-15.41 56.822-15.41 87.596 0 141.382 114.616 256 256 256 141.382 0 256-114.618 256-256 0-30.774-5.452-60.268-15.408-87.598 3.978 2.378 7.938 4.802 11.858 7.302v0zM512 416c0 53.020-42.98 96-96 96s-96-42.98-96-96 42.98-96 96-96 96 42.982 96 96z"></path>
						</symbol>
					</svg>
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
					<?php echo $item->url; ?>
					<svg class="icon icon-share">
						<use xlink:href="#icon-share"></use>
						<symbol id="icon-share" viewBox="0 0 1024 1024">
							<title>share</title>
							<path class="path1" d="M256 640c0 0 58.824-192 384-192v192l384-256-384-256v192c-256 0-384 159.672-384 320zM704 768h-576v-384h125.876c10.094-11.918 20.912-23.334 32.488-34.18 43.964-41.19 96.562-72.652 156.114-93.82h-442.478v640h832v-268.624l-128 85.334v55.29z"></path>
						</symbol>
					</svg>
				</a>
			</td>
			<td>
				<?php echo $item->time; ?>
			</td>
			<td>
				<span class="<?php echo $item->status_style ?> hasTooltip">
					<?php echo $item->status; ?>
					<span class="tooltipBox">
						Http Status: <?php echo $item->status ?>
					</span>
				</span>
				&nbsp;
				<?php if ($item->exception->notNull()): ?>
				    <span class="label label-danger hasTooltip">
						E
						<span class="tooltipBox">
							<?php echo $item->exception->type ?>
						</span>
					</span>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php $this->endblock(); ?>
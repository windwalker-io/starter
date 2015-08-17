<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

?>
<style>
<?php echo $data->style; ?>
</style>
<div id="windwalker-debugger">
	<!-- LOGO -->
	<div class="windwalker-debugger-block">
		<div class="windwalker-debugger-block-inner">
			<a href="http://windwalker.io" target="_blank">
				<img height="25px" class="windwalker-debugger-console-logo" src="data:image/png;base64,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"
					alt="Windwalker LOGO" />
			</a>
		</div>
	</div>

	<!-- VERSION -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('system', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				<span class="windwalker-debugger-badge">
					V <?php echo $this->escape($data->collector['windwalker.framework.version']); ?>
				</span>
			</div>
		</a>
	</div>

	<!-- METHOD -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('request', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				<span class="windwalker-debugger-badge">
					<?php echo $this->escape($data->collector['method']); ?>
				</span>
			</div>

			<!-- Drop MENU -->
			<div class="windwalker-debugger-drop-menu">
				<dl>
					<dt>HTTP Method</dt>
					<dd><?php echo $this->escape($data->collector['custom_method'] ? : $data->collector['method']); ?></dd>

					<dt>Custom Method</dt>
					<dd><?php echo$this->escape($data->collector['custom_method'] ? : 'None'); ?></dd>
				</dl>
			</div>
		</a>
	</div>

	<!-- ROUTING -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('routing', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				<span class="windwalker-debugger-badge" style="background-color: #5cb85c">
					<?php echo $this->escape($data->collector['http.status']); ?>
				</span>
				&nbsp;
				Route:
				<abbr title="<?php echo $this->escape($data->collector['main.controller']); ?>">
					<code><?php echo $this->escape($data->collector['route.matched']['name']); ?></code>
				</abbr>
			</div>

			<!-- Drop MENU -->
			<div class="windwalker-debugger-drop-menu">
				<dl>
					<dt>Status</dt>
					<dd>
						<span class="windwalker-debugger-badge" style="background-color: #5cb85c">
							<?php echo $this->escape($data->collector['http.status']); ?>
						</span>
					</dd>

					<dt>Route Name</dt>
					<dd><code><?php echo $this->escape($data->collector['route.matched']['name']); ?></code></dd>

					<dt>Controller</dt>
					<dd><code><?php echo $this->escape($data->collector['main.controller']); ?></code></dd>
				</dl>
			</div>
		</a>
	</div>

	<!-- TIME -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('timeline', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				<span class="windwalker-debugger-badge windwalker-debugger-color-<?php echo $data->timeStyle; ?>">
					Time: <?php echo $this->escape(round($data->time, 2)); ?> ms
				</span>
			</div>
		</a>
	</div>

	<!-- MEMORY -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('timeline', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				<span class="windwalker-debugger-badge windwalker-debugger-color-<?php echo $data->memoryStyle; ?>">
					Memory: <?php echo $this->escape(round($data->memory, 2)); ?> MB
				</span>
			</div>
		</a>
	</div>

	<!-- DATABASE -->
	<div class="windwalker-debugger-block">
		<a class="windwalker-debugger-link" href="<?php echo $data->router->html('database', array('id' => $data->collector['id'])); ?>">
			<div class="windwalker-debugger-block-inner">
				Queries
				<span class="windwalker-debugger-badge">
					<?php echo $this->escape($data->queryTimes); ?>
				</span>
			</div>

			<!-- Drop MENU -->
			<div class="windwalker-debugger-drop-menu">
				<dl>
					<dt>DB Queries</dt>
					<dd>
						<?php echo $this->escape($data->queryTimes); ?>
					</dd>

					<dt>Total Time</dt>
					<dd><?php echo $this->escape(round($data->queryTotalTime, 2)); ?> ms</dd>

					<dt>Total Memory</dt>
					<dd><?php echo $this->escape(round($data->queryTotalMemory, 3)); ?> MB</dd>
				</dl>
			</div>
		</a>
	</div>
</div>
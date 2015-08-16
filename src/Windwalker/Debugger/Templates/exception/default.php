<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Data\Data;
use Windwalker\Debugger\Html\BootstrapKeyValueGrid;
use Windwalker\Profiler\Point\Collector;
use Windwalker\String\Utf8String;
use Windwalker\Utilities\Reflection\ReflectionHelper;

$this->extend('_global.html');

/**
 * @var  Collector  $collector
 * @var  Data       $exception
 */
?>

<?php $this->block('page_title') ?>Exception<?php $this->endblock(); ?>

<?php $this->block('content') ?>

<?php if ($exception->notNull()): ?>
	<h2>Exception Information</h2>

	<?php
	echo BootstrapKeyValueGrid::create()
		->addHeader()
		->addItem('Type', $exception->type)
		->addItem('Message', $exception->message)
		->addItem('File', $exception->file . ' (' . $exception->line . ')');
	?>

	<br /><br />

	<h2>Call Stack</h2>

	<table class="table table-striped">
		<?php foreach ((array) $exception->trace as $i => $trace): ?>
			<?php
			$trace = new Data($trace);

			$args = array();

			foreach ($trace['args'] as $name => $value)
			{
				$value = is_array($value) ? 'Array(...)' : $value;
				$value = is_object($value) ? ReflectionHelper::getShortName($value) : $value;

				$args[$name] = Utf8String::substr($value, 0, 10);
			}
			?>
			<tr>
				<td>
					<?php echo $i + 1; ?>
				</td>
				<td>
					<?php echo $trace['file']; ?> (<?php echo $trace['line']; ?>)
				</td>
				<td>
					<?php echo $trace['class']; ?><?php echo $trace['type']; ?><?php echo $trace['function']; ?>(<?php echo implode(', ', $args); ?>)
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	No Exception caught.
<?php endif; ?>

<?php $this->endblock() ?>
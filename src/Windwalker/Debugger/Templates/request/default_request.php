<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Debugger\Html\BootstrapKeyValueGrid;

?>
<h2><?php echo strtoupper($type) ?> Variables</h2>

<?php if (!empty($collector['request'][$type])): ?>
	<?php
	$grid = BootstrapKeyValueGrid::create()->addHeader();

	foreach ($collector['request'][$type] as $key => $value)
	{
		if (is_array($value) || is_object($value))
		{
			$value = new \Windwalker\Dom\HtmlElement('pre', print_r($value, 1));
		}

		$grid->addItem($key, $value);
	}

	echo $grid;
	?>
	<br /><br />
<?php else: ?>
No data.
	<br /><br />
<?php endif; ?>
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Debugger\Html\BootstrapKeyValueGrid;
use Windwalker\Dom\HtmlElement;

?>
<h2><?php echo strtoupper($type) ?> Variables</h2>

<?php if (!empty($collector['request'][$type])): ?>
	<?php
	$grid = BootstrapKeyValueGrid::create()->addHeader();

	foreach ($collector['request'][$type] as $bagName => $bagValue)
	{
		if (is_array($bagValue) || is_object($bagValue))
		{
			$grid->addTitle(new HtmlElement('strong', $bagName));

			if ($bagValue)
			{
				foreach ($bagValue as $key => $value)
				{
					if (is_array($value) || is_object($value))
					{
						$value = new HtmlElement('pre', print_r($value, 1));
					}

					$grid->addItem($key, $value);
				}
			}
			else
			{
				$grid->addRow()
					->setRowCell('key', 'No Data', array('colspan' => 3));
			}
		}
		else
		{
			$grid->addItem($bagName, $bagValue);
		}
	}

	echo $grid;
	?>
	<br /><br />
<?php else: ?>
No data.
	<br /><br />
<?php endif; ?>
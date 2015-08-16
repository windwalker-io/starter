<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Debugger\Html\BootstrapKeyValueGrid;
use Windwalker\Html\Grid\KeyValueGrid;
use Windwalker\Dom\HtmlElement;
use Windwalker\Profiler\Profiler;

$this->extend('_global.html');

/**
 * @var  Profiler  $profiler
 */
?>

<?php $this->block('page_title') ?>Database<?php $this->endblock(); ?>

<?php $this->block('content') ?>

<h2>Database Information</h2>

<?php
echo BootstrapKeyValueGrid::create()
	->addHeader('Key', 'Value')
	->addItem('Database Driver', $collector['database.driver.name'])
	->addItem('Database Driver Class', new HtmlElement('code', $collector['database.driver.class']))
	->addTitle(new HtmlElement('strong', 'Options'))
	->addItems($options);
?>

	<br /><br />

<h2>Queries</h2>

<?php foreach ((array) $queryProcess as $name => $timeline): ?>

	<br />
	<?php echo $this->load('query_info', array('timeline' => $timeline)) ?>
	<br />

<?php endforeach; ?>

<?php $this->endblock() ?>
<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Html\Grid\KeyValueGrid;
use Windwalker\Profiler\Point\Collector;

$this->extend('_global.html');

/**
 * @var  Collector  $collector
 */
?>

<?php $this->block('page_title') ?>Events<?php $this->endblock(); ?>

<?php $this->block('content') ?>

<h2>Event Executed</h2>

<?php echo $this->load('events', array('events' => $executed)); ?>

	<br /><br />

<h2>Event No Executed</h2>

<?php echo $this->load('events', array('events' => $noExecuted)); ?>


<?php $this->endblock() ?>
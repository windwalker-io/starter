<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Profiler\Profiler;

$this->extend('_global.html');

/**
 * @var  Profiler  $profiler
 */
?>

<?php $this->block('page_title') ?>Database<?php $this->endblock(); ?>

<?php $this->block('content') ?>
<h2>Queryies</h2>

<?php foreach ($queryProcess['timeline'] as $name => $timeline): ?>

	<br />
	<?php echo $this->load('query_info', array('timeline' => $timeline)) ?>
	<br />

<?php endforeach; ?>

<?php $this->endblock() ?>
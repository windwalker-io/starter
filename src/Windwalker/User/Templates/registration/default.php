<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

/**
 * @var \Windwalker\Data\Data $data
 */
$root = $data->uri['base.path'];

$this->extend('_global.html');
?>

<?php $this->block('style'); ?>
<link rel="stylesheet" href="<?php echo $root; ?>media/css/acme/page.css" />
<link rel="stylesheet" href="<?php echo $root; ?>media/css/user/bs3-fix.css" />
<?php $this->endblock(); ?>

<?php $this->block('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo $data->uri['current']; ?>" class="form-horizontal" method="post">
				<fieldset>
					<legend>REGISTRATION</legend>
					<?php echo $data->form->renderFields(); ?>

					<div class="buttons">
						<button class="btn btn-primary" type="submit">Register</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php $this->endblock(); ?>


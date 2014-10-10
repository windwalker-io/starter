<?php
$root = $data->uri->get('base.path');
?><!doctype html>
<html lang="zh-tw">
<head>
	<meta charset="UTF-8">
	<title><?php $this->block('siteTitle'); ?><?php $this->endblock(); ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $root; ?>media/images/favicon.ico" />
	<meta name="generator" content="Formosa | Windwalker Framework" />
	<?php $this->block('meta'); ?>
	<?php $this->endblock(); ?>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $root; ?>media/css/page.css" />
	<?php $this->block('style'); ?>
	<?php $this->endblock(); ?>

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<?php $this->block('script'); ?>
	<?php $this->endblock(); ?>

</head>
<body>
<?php $this->block('navbar'); ?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="">Windwalker</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php $this->block('nav'); ?>
				<li class="active"><a href="<?php echo $root; ?>">Home</a></li>
				<?php $this->endblock(); ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">

			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>
<?php $this->endblock(); ?>

<?php $this->block('message') ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php foreach ($data->flashes as $type => $msgs): ?>
				<?php foreach ($msgs as $msg): ?>
				<div class="alert alert-<?php echo $type; ?>">
					<?php echo $msg; ?>
				</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php $this->endblock(); ?>

<?php $this->block('content') ?>
Contnet
<?php $this->endblock(); ?>

<?php $this->block('copyblock') ?>
<div id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<hr />

				<footer>
					&copy; Formosa <?php echo $data->datetime->year; ?>
				</footer>
			</div>
		</div>
	</div>
</div>
<?php $this->endblock(); ?>
</body>
</html>
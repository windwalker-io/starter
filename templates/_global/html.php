<!DOCTYPE html>
<html lang="<?php echo $app->get('language.locale') ? : $app->get('language.default', 'en-GB'); ?>">
<head>
	<meta charset="UTF-8">
	<title><?php $this->block('page_title'); ?><?php $this->endblock(); ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $uri->path; ?>/asset/images/favicon.ico" />
	<meta name="generator" content="Windwalker Framework" />
	<?php $this->block('meta'); ?>
	<?php $this->endblock(); ?>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $uri->path; ?>/asset/css/main.css" />
	<?php $this->block('style'); ?><?php $this->endblock(); ?>
<?php echo $asset->renderStyles(true); ?>

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<?php $this->block('script'); ?><?php $this->endblock(); ?>
<?php echo $asset->renderScripts(true); ?>
</head>
<body>
<?php $this->block('navbar'); ?>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $router->route('home'); ?>">
				<img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="Windwalker LOGO" />
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php $this->block('nav'); ?>
				<li class="active"><a href="<?php echo $router->route('home'); ?>">Home</a></li>
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
	<div id="messasge" class="container">
		<?php echo $widget->render('windwalker.message.default', ['messages' => $messages]); ?>
	</div>
<?php $this->endblock(); ?>

<?php $this->block('content') ?>
Contnet
<?php $this->endblock(); ?>

<?php $this->block('copyright') ?>
<div id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<hr />

				<footer>
					&copy; Windwalker <?php echo $datetime->format('Y'); ?>
				</footer>
			</div>
		</div>
	</div>
</div>
<?php $this->endblock(); ?>
<?php echo $asset->getTemplate()->renderTemplates(); ?>
</body>
</html>
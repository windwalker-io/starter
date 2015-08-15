<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Core\Router\PackageRouter;
use Windwalker\Registry\Registry;

/**
 * @var Registry        $uri
 * @var AbstractPackage $package
 * @var PackageRouter   $router
 */
?><!doctype html>
<html lang="zh-tw">
<head>
	<meta charset="UTF-8">
	<title><?php $this->block('page_title'); ?><?php $this->endblock(); ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $uri['media.path'] ?>>media/images/favicon.ico" />
	<meta name="generator" content="Windwalker Framework" />
	<?php $this->block('meta'); ?>
	<?php $this->endblock(); ?>

	<link rel="stylesheet" href="<?php echo $uri['media.path'] ?><?php echo $package->getName() ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $uri['media.path'] ?><?php echo $package->getName() ?>/css/debugger.css" />
	<?php $this->block('style'); ?>
	<?php $this->endblock(); ?>

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="<?php echo $uri['media.path'] ?><?php echo $package->getName() ?>bootstrap/js/bootstrap.min.js"></script>
	<?php $this->block('script'); ?>
	<?php $this->endblock(); ?>

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
			<a class="navbar-brand" href="<?php echo $router->html('home'); ?>">
<!--				<img src="https://cloud.githubusercontent.com/assets/1639206/2870854/176b987a-d2e4-11e3-8be6-9f70304a8499.png" alt="Windwalker LOGO" />-->
				Windwalker Debugger
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php $this->block('nav'); ?>
				<li class="<?php echo $helper->view->isActiveRoute('dashboard') ?>"><a href="<?php echo $router->html('dashboard'); ?>">Dashboard</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('system') ?>"><a href="<?php echo $router->html('system'); ?>">System</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('request') ?>"><a href="<?php echo $router->html('request'); ?>">Request</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('timeline') ?>"><a href="<?php echo $router->html('timeline'); ?>">Timeline</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('events') ?>"><a href="<?php echo $router->html('home'); ?>">Events</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('logs') ?>"><a href="<?php echo $router->html('home'); ?>">Logs</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('database') ?>"><a href="<?php echo $router->html('database'); ?>">Database</a></li>
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
<?php echo $this->load('windwalker.message.default'); ?>
<?php $this->endblock(); ?>

<div class="header-title jumbotron">
	<div class="container">
		<h1><?php $this->block('page_title'); ?><?php $this->endblock(); ?></h1>
	</div>
</div>

<div class="main-body container">
	<?php $this->block('content') ?>
	Content
	<?php $this->endblock(); ?>
</div>

<?php $this->block('copyblock') ?>
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
</body>
</html>
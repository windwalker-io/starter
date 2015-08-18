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

	<link rel="shortcut icon" type="image/x-icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAWdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjA76PVpAAABg0lEQVRYR+3UOyhHUQDH8euVFIO3SB5lYKaUiWRQsjBjUIqUyEKyktfkUSxEWaSQxKIYvEuxySqyI6/v75wuf48kuQadb33qnH90zv2f87+ey+Vyud6VjzaMYBgdqEURcpCLbHynNDRgCOPoRQk+LQz6wzvsYBknuMfTO+Xwi0aiHb6UhWlsoROVqEArjjCLcLxJOz2FnjAS/dCG4lCIGhzjDNqs0sLrSDEzWyN2UWpmH4uANldvZiFpt3V2aJ5Ai+4jWR+QFrtBj5l5Xjq04QUzs5uewAxi9MEXxaPZDl/TP/bZoakMG3ZoasEDdP6p8I+nClp8HgP4cXrSJRxgGyvQQn66F5uIhb6ZOVwiClMYw6+kM5fQ8vCIJixiELqko+jCKnS2gaVFbqGfpr4F3REdhy6qLqXONNAOcY0L6PK1Q+d/hWIEml4+/u+/Wh/QHjTXiyXw9PLQYpNmZu+D5vqt6/YH3hrO4V/Mbuh9UGBmf1AmEuzQlIQMO3S5XK5/kec9A3l6TjrQtGhFAAAAAElFTkSuQmCC" />
	<meta name="generator" content="Windwalker Framework" />
	<?php $this->block('meta'); ?>
	<?php $this->endblock(); ?>

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,300,700' rel='stylesheet' type='text/css'>
	<style>
<?php echo $themeStyle; ?>
	</style>
	<?php $this->block('style'); ?>
	<?php $this->endblock(); ?>

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
			<a class="navbar-brand" href="<?php echo $router->html('dashboard'); ?>">
				Windwalker Debugger
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php $this->block('nav'); ?>
				<li class="<?php echo $helper->view->isActiveRoute('system') ?>"><a href="<?php echo $router->html('system'); ?>">System</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('request') ?>"><a href="<?php echo $router->html('request'); ?>">Request</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('routing') ?>"><a href="<?php echo $router->html('routing'); ?>">Routing</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('timeline') ?>"><a href="<?php echo $router->html('timeline'); ?>">Timeline</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('events') ?>"><a href="<?php echo $router->html('events'); ?>">Events</a></li>

				<li class="<?php echo $helper->view->isActiveRoute('database') ?>"><a href="<?php echo $router->html('database'); ?>">Database</a></li>
				<li class="<?php echo $helper->view->isActiveRoute('exception') ?>"><a href="<?php echo $router->html('exception'); ?>">Exception</a></li>
				<?php $this->endblock(); ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a target="_blank" href="<?php echo $uri['base.path'] . $uri['script']; ?>">
						<svg class="icon icon-earth">
							<use xlink:href="#icon-earth"></use>
							<symbol id="icon-earth" viewBox="0 0 1024 1024">
								<title>earth</title>
								<path class="path1" d="M512 0c-282.77 0-512 229.23-512 512s229.23 512 512 512 512-229.23 512-512-229.23-512-512-512zM512 960.002c-62.958 0-122.872-13.012-177.23-36.452l233.148-262.29c5.206-5.858 8.082-13.422 8.082-21.26v-96c0-17.674-14.326-32-32-32-112.99 0-232.204-117.462-233.374-118.626-6-6.002-14.14-9.374-22.626-9.374h-128c-17.672 0-32 14.328-32 32v192c0 12.122 6.848 23.202 17.69 28.622l110.31 55.156v187.886c-116.052-80.956-192-215.432-192-367.664 0-68.714 15.49-133.806 43.138-192h116.862c8.488 0 16.626-3.372 22.628-9.372l128-128c6-6.002 9.372-14.14 9.372-22.628v-77.412c40.562-12.074 83.518-18.588 128-18.588 70.406 0 137.004 16.26 196.282 45.2-4.144 3.502-8.176 7.164-12.046 11.036-36.266 36.264-56.236 84.478-56.236 135.764s19.97 99.5 56.236 135.764c36.434 36.432 85.218 56.264 135.634 56.26 3.166 0 6.342-0.080 9.518-0.236 13.814 51.802 38.752 186.656-8.404 372.334-0.444 1.744-0.696 3.488-0.842 5.224-81.324 83.080-194.7 134.656-320.142 134.656z"></path>
							</symbol>
						</svg>
						Preview
					</a>
				</li>
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
		<p>
			<a class="btn btn-sm btn-info" href="<?php echo $router->html('dashboard'); ?>"
				data-toggle="tooltip" data-placement="top" title="Choose other URLs">
				<svg class="icon icon-list">
					<use xlink:href="#icon-list"></use>
					<symbol id="icon-list" viewBox="0 0 1024 1024">
						<title>list</title>
						<path class="path1" d="M0 0h256v256h-256zM384 64h640v128h-640zM0 384h256v256h-256zM384 448h640v128h-640zM0 768h256v256h-256zM384 832h640v128h-640z"></path>
					</symbol>
				</svg>
			</a>
			<a class="btn btn-sm btn-success" href="<?php echo $router->html($app->get('route.matched'), array('refresh' => 1, 'id' => $item['id'])); ?>"
				data-toggle="tooltip" data-placement="top" title="Refresh to latest URL">
				<svg class="icon icon-spinner11">
					<use xlink:href="#icon-spinner11"></use>
					<symbol id="icon-spinner11" viewBox="0 0 1024 1024">
						<title>spinner11</title>
						<path class="path1" d="M1024 384h-384l143.53-143.53c-72.53-72.526-168.96-112.47-271.53-112.47s-199 39.944-271.53 112.47c-72.526 72.53-112.47 168.96-112.47 271.53s39.944 199 112.47 271.53c72.53 72.526 168.96 112.47 271.53 112.47s199-39.944 271.528-112.472c6.056-6.054 11.86-12.292 17.456-18.668l96.32 84.282c-93.846 107.166-231.664 174.858-385.304 174.858-282.77 0-512-229.23-512-512s229.23-512 512-512c141.386 0 269.368 57.326 362.016 149.984l149.984-149.984v384z"></path>
					</symbol>
				</svg>
			</a>
			/
			ID: <span class="text-muted"><?php echo $item->id; ?></span>
			/
			<a class="text-muted" href="<?php echo $item['collector']['uri']['full'] ?>" target="_blank">
				<?php echo $item['collector']['uri']['full'] ?>
				<svg style="height: 15px" class="icon icon-share">
					<use xlink:href="#icon-share"></use>
					<symbol id="icon-share" viewBox="0 0 1024 1024">
						<title>share</title>
						<path class="path1" d="M256 640c0 0 58.824-192 384-192v192l384-256-384-256v192c-256 0-384 159.672-384 320zM704 768h-576v-384h125.876c10.094-11.918 20.912-23.334 32.488-34.18 43.964-41.19 96.562-72.652 156.114-93.82h-442.478v640h832v-268.624l-128 85.334v55.29z"></path>
					</symbol>
				</svg>
			</a>
		</p>
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